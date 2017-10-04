<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Response;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;
use App\Product;
use App\Item;
use App\Machine;

class APIController extends Controller {
    private $_expirationTime = 5;

    public function getCredentials(Request $request) {
        if(!$request->has('machine_id'))
            return response()->json(Response::set(false, 'El parametro [machine_id] no ha si encontrado'));

        $machine_id = $request->input('machine_id');
        $machine    = Machine::find($machine_id);

        if(is_null($machine))
            return response()->json(Response::set(false, 'La máquina no ha sido encontrada'));

        $password = 'agualu2017' . str_random(5);
        $machine->password = $password;
        $machine->save();

        return response()->json(Response::set(true, "Contraseña para máquina #$machine_id correctamente generada", ['password' => $password]));
    }

    public function authenticate(Request $request) {
        if(!$request->has('machine_id'))
            return response()->json(Response::set(false, 'El parametro [machine_id] no ha si encontrado'));

        if(!$request->has('password'))
            return response()->json(Response::set(false, 'El parametro [password] no ha si encontrado'));

        $machine_id = $request->input('machine_id');
        $machine    = Machine::find($machine_id);

        if(is_null($machine))
            return response()->json(Response::set(false, 'La máquina no ha sido encontrada'));

        if(!\Hash::check($request->input('password'), $machine->password))
            return response()->json(Response::set(false, 'La contraseña no coincide con la generada por el servidor'));

        return response()->json(Response::set(true, 'Token successfully created', ["token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9zeXN0ZW0uY2FtcGVzdHJlY2VsYXlhLm14L2FwaS9hdXRoZW50aWNhdGUiLCJpYXQiOjE1MDY5MTk1NjQsImV4cCI6MTUwNjkyMzE2NCwibmJmIjoxNTA2OTE5NTY0LCJqdGkiOiJ4emV5Y3RRNVpGanNRWG56In0.43RWbUSDbGrKnxNiJ6CY4MILAabyN_sWqMhe-zfO12M", 'ttl' => 5]));
    }

    public function import_users() {
        $users = User::all();
        $response = [];

        foreach ($users as $user) {
            $response[] = [
                'number'    => $user->id,
                'password'  => $user->password,
                'money'     => $user->budget ?: 0
            ];
        }

        return response()->json($response);
    }

    public function import_products() {
        $items = Item::all();

        $response = [];

        $times = [10, 10, 15, 200, 400];

        foreach ($items as $k => $item) {
            $response[] = [
                'id'                => $item->id,
                'nombre'            => $item->name,
                'precio_socio'      => (float) $item->distributor_price,
                'precio_publico'    => (float) $item->public_price,
                'flujo'             => $item->flow,
                'unidad'            => $item->unit,
                'segundos'          => $times[$k],
            ];
        }

        return response()->json($response);
    }

    public function import_parameters() {
        // $products = Product::all();

        $response = [];

        // foreach ($products as $product) {
            $response = [
                'precio_inscripcion'    => null,
            ];
        // }

        return response()->json($response);
    }


    public function send_sales(Request $request) {
        return response()->json(['process' => 'Abono Completado']);
    }

    public function send_registration(Request $request) {
        return response()->json(['process' => 'Ok']);
    }

    public function save_credit(Request $request) {
        return response()->json(['process' => 'Abono Completado', 'money' => rand(100, 500)]);
    }

    public function send_error(Request $request) {
        return response()->json(['process' => 'Mensaje Enviado']);
    }
}
