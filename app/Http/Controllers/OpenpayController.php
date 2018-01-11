<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Openpay;

use User;

class OpenpayController extends Controller {
    private $openpay = null;
    private $id = 'mvmzgrfww4wvppeubcee';
    private $private_key = 'sk_8a176cc9984247b98b6174e515b9cbab';
    private $production_mode = true;

    public function __construct() {
        $this->openpay = Openpay::getInstance($this->id, $this->private_key);
        Openpay::setProductionMode($this->production_mode);
    }

    public function card(Request $request) {
        $user = Auth::user();

        $customer = $this->_makeCustomerArray($user);
        $chargeData = array(
            'method' => 'card',
            'source_id' => $request->input('token_id'),
            'amount' => (float) $request->input('amount'),
            'description' => 'Monedero electrónico (agualu.com)',
            'use_card_points' => $request->input('use_card_points'), // Opcional, si estamos usando puntos
            'device_session_id' => $request->input('deviceIdHiddenFieldName'),
            'customer' => $customer
        );

        try {
            $charge = $this->openpay->charges->create($chargeData);

            return redirect()->route('view_user', ['id' => $user->id]);
        }
        catch(\OpenpayApiTransactionError $e) {
            return back()->withErrors(['msg' => $this->_mapCodeError($e->getErrorCode())]);
        }
        catch (\OpenpayApiRequestError $e) {
            return back()->withErrors(['msg' => 'Hubo un error con el servidor, intenta más tarde.']);
        }
    }

    public function stores(Request $request) {
        $user = Auth::user();

        $customer = $this->_makeCustomerArray($user);

        $chargeData = array(
            'method' => 'store',
            'amount' => (float) $request->input('amount'),
            'description' => 'Monedero electrónico (agualu.com)',
            'customer'  => $customer
        );

        try {
            $charge = $this->openpay->charges->create($chargeData);
            session(['charge' => $charge]);
            return redirect()->route('stores_ticket', ['id' => $charge->id]);
        }
        catch(Exception $e) {
            die($e->getMessage());
        }

    }

    public function ticket($id) {
        $charge = session('charge');
        // TODO Validation and store of that charge

        return view('openpay.ticket', [
            'order' => $charge
        ]);

    }

    private function _makeCustomerArray($user) {
        return [
            'name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone_number' => $user->phone,
            'email' => $user->email
        ];
    }

    private function _mapCodeError($code) {
        switch($code) {
            case 3001: return 'La tarjeta fue rechazada.';
            case 3002: return 'La tarjeta ha expirado.';
            case 3003: return 'La tarjeta no tiene fondos suficientes.';
            case 3004: return 'La tarjeta ha sido identificada como una tarjeta robada.';
            case 3005: return 'La tarjeta ha sido rechazada por el sistema antifraudes.';
            case 3001: return 'La tarjeta fue rechazada.';
            case 3002: return 'La tarjeta ha expirado.';
            case 3003: return 'La tarjeta no tiene fondos suficientes.';
            default: return 'I don\'t have idea why your card is rejected';
        }
    }

    public function webhook() {
        $body = @file_get_contents('php://input');
        $data = json_decode($body);

        switch ($data->type) {
            case 'verification':
				$codigo = $data->verification_code;
				file_put_contents('codigo.txt', $codigo);
				header("HTTP/1.1 200 OK");
				break;

            case 'charge.succeeded':

                $charge = $this->openpay->charges->get($data->transaction->id);
                $email = $charge->customer->email;

                $user = User::where('email', $email)->first();

                if(!is_null($user)) {
                    $user->addPayment('Abono a monedero por medio de plataforma', $data->transaction->amount);
                    $user->save();

                    //TODO Send an email confirmation, thanks for your
                }

            	header("HTTP/1.1 200 OK");
                break;

            default:
                # code...
                break;
        }
        // http_response_code(200); // Return 200 OK
    }

}
