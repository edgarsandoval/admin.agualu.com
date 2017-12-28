<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Response;
use Illuminate\Support\Facades\DB;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Commission;
use App\ErrorLog;
use App\Item;
use App\Machine;
use App\Product;
use App\Sale;
use App\State;
use App\User;
use App\Report;

use Mail;
use Setting;

class APIController extends Controller {
    private $_expirationTime = 5;
    private $_failedAuth = ['status' => false, 'msg' => 'token_required', 'data' => null];
    public $monthEndings     = [31, 28, 31, 30, 31, 30, 30, 31, 30, 31, 30, 31];

    public function testMail() {
        $user = User::find(34);
        $password = 1234;

        Mail::send('emails.welcome', compact('user', 'password'), function ($m) use ($user) {
           $m->from('no-reply@agualu.com', 'Agualu | Mailer');

           $m->to($user->email)->subject('¡Bienvenido a la red Agualu!');
        });

        return response()->json(Response::set(true, 'Mail enviado'));
    }

    public function getCredentials(Request $request) {
        if(!$request->has('machine_id'))
            return response()->json(Response::set(false, 'El parametro [machine_id] no ha sido encontrado'));

        $machine_id = $request->input('machine_id');
        $machine    = Machine::find($machine_id);

        if(is_null($machine))
            return response()->json(Response::set(false, 'La máquina no ha sidodo encontrada'));

        $password = 'agualu2017' . str_random(5);
        $machine->password = $password;
        $machine->save();

        return response()->json(Response::set(true, "Contraseña para máquina #$machine_id correctamente generada", ['password' => $password]));
    }

    public function authenticate(Request $request) {
        if(!$request->has('machine_id'))
            return response()->json(Response::set(false, 'El parametro [machine_id] no ha sido encontrado'));

        if(!$request->has('password'))
            return response()->json(Response::set(false, 'El parametro [password] no ha sido encontrado'));

        $machine_id = $request->input('machine_id');
        $machine    = Machine::find($machine_id);

        $credentials = $request->only('machine_id', 'password');
        // dd($credentials);

        return response()->json(Response::set(true, 'Token successfully created', ["token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9zeXN0ZW0uY2FtcGVzdHJlY2VsYXlhLm14L2FwaS9hdXRoZW50aWNhdGUiLCJpYXQiOjE1MDY5MTk1NjQsImV4cCI6MTUwNjkyMzE2NCwibmJmIjoxNTA2OTE5NTY0LCJqdGkiOiJ4emV5Y3RRNVpGanNRWG56In0.43RWbUSDbGrKnxNiJ6CY4MILAabyN_sWqMhe-zfO12M", 'ttl' => 5]));
    }

    public function exportUsers(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        $users = User::all();
        $response = [];

        foreach ($users as $user) {
            $response[] = [
                'number'    => $user->id,
                'password'  => $user->password,
                'money'     => (float) $user->budget ?: 0
            ];
        }

        return response()->json(Response::set(true, null, ['users' => $response]));
    }

    public function exportProducts(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        $items = Item::orderBy('order')->get();

        $response = [];

        foreach ($items as $k => $item) {
            $response[] = [
                'id'                => $item->order,
                'nombre'            => $item->name,
                'precio_socio'      => (float) $item->distributor_price,
                'precio_publico'    => (float) $item->public_price,
                'flujo'             => $item->flow ?: 0,
                'unidad'            => $item->unit,
                'segundos'          => $item->time,
            ];
        }

        return response()->json(Response::set(true, null, ['products' => $response]));
    }

    public function exportParameters(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        $name = 'registration_fee';

        $response = [
            'precio_inscripcion'    => (float )Setting::get($name, 30),
        ];

        return response()->json(Response::set(true, null, $response));
    }

    public function exportCodes(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        $codes = DB::table('likestealer')->select('code')->where('redeemed', 0)->get();

        $response = ['codes' => []];

        foreach($codes as $code)
            $response['codes'][] = $code->code;

        return response()->json(Response::set(true, null, $response));
    }


    public function sendSales(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        $fields = ['user_id', 'machine_id', 'product_id', 'amount', 'is_public'];

        foreach($fields as $field)
            if(!$request->has($field))
                return response()->json(Response::set(false, 'El parametro [' . $field . '] no ha sido encontrado'));

        $data = $request->all();

        if($request->input('is_public'))
            $data['user_id'] = null;

        $sale = Sale::create($data);

        // First step, we need to deposit the part that correspond to the owner;

        $machine = Machine::find($request->input('machine_id'));
        $ownerCommission = Commission::create([
            'user_id'   => $machine->user_id,
            'sale_id'   => $sale->id,
            'amount'    => $this->_calculatePercentaje($data['amount'], Setting::get('owner_percentage')),
            'tax'       => $this->_calculatePercentaje($data['amount'], Setting::get('owner_percentage')) * 0.16,
            'level'     => 0,
        ]);
        $ownerCommission->user->current_earnings += $ownerCommission->amount;
        $ownerCommission->user->save();

        // After that we need to define, which one going to be the first node on th graph.
        $queue = new \SplQueue();

        if($request->input('is_public')) { // In this point is necessary consider the machine that host the member
            $firstNode          = $machine->father;
            $firstNode->level   = 1;
            $queue->push($firstNode);
        }
        else {// Or here we don't care the machine, just the member who did the sale
            $user = User::find($request->input('user_id'));

            if(!is_null($user->father)) {
                $firstNode          = $user->father;
                $firstNode->level   = 1;
                $queue->push($firstNode);
            }
        }

        // Once that we choosed, the first node we need to start the travel.

        while(!$queue->isEmpty()) {
            $node = $queue->pop();

            if($node->level > 7)
                break;

            // If the node is an [User], just calculate the percentage accord to it level.
            // Else calculate the percentage to it's level and add them to owner machine.
            $userID = $node instanceof User ? $node->id : $node->user_id;

            $memberCommission = Commission::create([
                'user_id'   => $userID,
                'sale_id'   => $sale->id,
                'amount'    => $this->_calculatePercentaje($data['amount'], Setting::get('level_' . $node->level . '_percentage')),
                'tax'       => $this->_calculatePercentaje($data['amount'], Setting::get('level_' . $node->level . '_percentage')) * 0.16,
                'level'     => $node->level,
            ]);
            $memberCommission->user->current_earnings += $memberCommission->amount;
            $memberCommission->user->save();

            if(!is_null($node->father)) {
                $nextNode           = $node->father;
                $nextNode->level    = $node->level + 1;

                $queue->push($nextNode);
            }

        }

        return response()->json(Response::set(true, 'Abono completado'));
    }

    private function _calculatePercentaje($amount, $percentage) {
        $amount         = (float) $amount;
        $percetnaje     = (float) $percentage;

        return $amount * ($percentage / 100);
    }

    public function sendRegistration(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        try {
            $fields = ['name', 'email', 'machine_id', 'user_id'];

            foreach($fields as $field)
                if(!$request->has($field))
                    return response()->json(Response::set(false, 'El parametro [' . $field . '] no ha sido encontrado'));

            $password = rand(1000, 9999);

            $machine = Machine::find($request->input('machine_id'));

            $data = [
                'first_name'        => $request->input('name'),
                'last_name'         => '',
                'email'             => $request->input('email'),
                'password'          => $password,
                'state_id'          => $machine->state_id,
                'street'            => '',
                'outdoor_number'    => 0,
                'suburb'            => '',
                'postal_code'       => '',
                'range_id'          => 1,
                'preferential'      => 0,
                'status'            => 'Vigente',
            ];

            if($request->input('user_id') == 0) // This means nobody refer this new user, so it will be a [Machine] children
                $data['machine_id'] = $machine->id;
            else // Otherwise, this user is te refered member, so it will be [User] children
                $data['user_id']     = $request->input('user_id');

            $user = User::create($data);
            $user->member_code = $user->state->acronym . '-' . str_pad(count(State::find($user->state->id)->users), 4, "0", STR_PAD_LEFT);
            $user->assignRole(Role::where('id', '=', 2)->firstOrFail());
            $user->save();

            Mail::send('emails.welcome', compact('user', 'password'), function ($m) use ($user) {
               $m->from('no-reply@agualu.com', 'Agualu | Mailer');

               $m->to($user->email)->subject('¡Bienvenido a la red Agualu!');
            });

            return response()->json(Response::set(true, 'Ok'));

        } catch(\Exception $e) {
            return response()->json(Response::set(false, $e->getMessage()));
        }
    }

    public function saveCredit(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        if(!$request->has('user_id'))
            return response()->json(Response::set(false, 'El parametro [user_id] no ha sido encontrado'));

        if(!$request->has('amount'))
            return response()->json(Response::set(false, 'El parametro [amount] no ha sido encontrado'));

        $user_id = $request->input('user_id');

        $user = User::find($user_id);

        if(is_null($user))
            return response()->json(Response::set(false, 'El usuario no ha sidodo encontrada'));

        $user->budget += $request->input('amount');
        $user->save();

        return response()->json(Response::set(true, 'Abono Completado', ['money' => $user->budget]));
    }

    public function sendError(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);

        try {

            $fields = ['incident_token', 'machine_series', 'message', 'user_id', 'machine_id', 'is_public'];

            foreach($fields as $field)
                if(!$request->has($field))
                    return response()->json(Response::set(false, 'El parametro [' . $field . '] no ha sido encontrado'));

            $data = $request->all();

            if($request->input('is_public'))
                $data['user_id'] = null;

            $errorLog = ErrorLog::create($data);

            return response()->json(Response::set(true, 'Mensaje Enviado'));
        } catch(\Exception $e) {
            return response()->json(Response::set(false, $e->getMessage()));
        }
    }

    public function sendCode(Request $request) {
        if(is_null($request->header('Authorization')))
            return response()->json($this->_failedAuth);


            $fields = ['code'];

            foreach($fields as $field)
                if(!$request->has($field))
                    return response()->json(Response::set(false, 'El parametro [' . $field . '] no ha sido encontrado'));

        try {
            if(DB::table('likestealer')->where('code', $request->input('code'))->update(['redeemed' => 1]))
                return response()->json(Response::set(true, 'Ok'));
            else
                throw new \Exception();
        } catch(\Exception $e) {
            return response()->json(Response::set(false, 'El código no ha podido ser encontrado'));
        }
    }

    public function cuts() {
        // Fisrt, we'll create a new register for this period
        $data = [];
        $data['period'] = date('Y') . date('m') . (date('j') > 15 ? 2 : 1);
        $period = $this->_getPeriodFromDate(date('j'));
        $commonDate = date('Y-m-');
        $data['from']   = $commonDate . $period->start_date;
        $data['to']     = $commonDate . $period->end_date;

        $report = Report::create($data);

        // After that, for each user in the network we'll deposit its earnings on its respective virtual wallets.
        $users = User::all();
        foreach ($users as $user) {
            $user->budget += $user->current_earnings;
            $user->current_earnings = 0;
            $user->save();
        }

        return 1;
    }

    private function _getPeriodFromDate($period) {
        if($period < 15)
            return (object) [
                'start_date' => 1,
                'end_date'   => 15,
            ];
        else
            return (object) [
                'start_date' => 16,
                'end_date'   => $this->monthEndings[date('n') - 1],
            ];
    }
}
