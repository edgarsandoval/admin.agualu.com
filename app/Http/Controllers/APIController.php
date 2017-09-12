<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;

class APIController extends Controller {
    public function import_users() {
        $users = User::all();
        $response = [];

        foreach ($users as $user) {
            $response[] = [
                'number'    => $user->member_code,
                'password'  => $user->password,
                'money'     => $user->budget ?: 0
            ];
        }

        return response()->json($response);
    }

    public function import_products() {
        $products = Product::all();

        $response = [];

        foreach ($products as $product) {
            $response[] = [
                'id'                => $product->id,
                'precio_socio'      => $product->distributor_price,
                'precio_publico'    => $product->public_price
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
