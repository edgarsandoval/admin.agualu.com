<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;
use App\Item;

class APIController extends Controller {
    public function getCredentials(Request $request) {
        if(!$request->has('machine_id'))
            return response()->json(['status' => false, 'msg' => 'El parametro [machine_id] no ha si encontrado', 'data' => null]);

        $machine_id = $request->input('machine_id');

        if(!in_array($machine_id, [1, 2, 3]))
            return response()->json(['status' => false, 'msg' => 'La máquina no ha sido encontrada', 'data' => null]);

        return response()->json(['status' => true, 'msg' => "Contraseña para máquina #$machine_id correctamente generada", 'data' => [
            'password' => 'agualu20171hJu'
            ]]);
    }

    public function authenticate(Request $request) {
        if(!$request->has('machine_id'))
            return response()->json(['status' => false, 'msg' => 'El parametro [machine_id] no ha si encontrado', 'data' => null]);

            if(!$request->has('password'))
                return response()->json(['status' => false, 'msg' => 'El parametro [password] no ha si encontrado', 'data' => null]);

        if(!\Hash::check($request->input('password'), bcrypt('agualu20171hJu')))
            return response()->json(['status' => false, 'msg' => 'La contraseña no coincide con la generada por el servidor', 'data' => null]);

        $response = [
            "status" => true,
            "msg" => "Token successfully created",
            "data"=> ["token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9zeXN0ZW0uY2FtcGVzdHJlY2VsYXlhLm14L2FwaS9hdXRoZW50aWNhdGUiLCJpYXQiOjE1MDY5MTk1NjQsImV4cCI6MTUwNjkyMzE2NCwibmJmIjoxNTA2OTE5NTY0LCJqdGkiOiJ4emV5Y3RRNVpGanNRWG56In0.43RWbUSDbGrKnxNiJ6CY4MILAabyN_sWqMhe-zfO12M"],
            "ttl" => 5];

        return response()->json($response);
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
