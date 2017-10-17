<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Response;
use Illuminate\Support\Facades\DB;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\ErrorLog;
use App\Item;
use App\Machine;
use App\Product;
use App\State;
use App\User;

use Mail;

class APIController extends Controller {
    private $_expirationTime = 5;
    private $_failedAuth = ['status' => false, 'msg' => 'token_required', 'data' => null];

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

        $response = [
            'precio_inscripcion'    => 30,
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

        // if(is_null(User::find($request->input('user_id'))))
        return response()->json(Response::set(true, 'Abono completado'));
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

            //$errorLog = ErrorLog::create($request->all());


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
}
