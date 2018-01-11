<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Response;
use App\Order;
use App\Product;
use Cart;

class CartController extends Controller {
    public function index() {
        $cart = Cart::getContent();
        $subtotal = Cart::getSubTotal();
        $balance = Auth::user()->budget;

        return view('cart.index', compact('cart', 'subtotal', 'balance'));
    }

    public function add(Request $request) {
        $product = Product::find($request->input('product_id'));

        try {
            Cart::add($product->sku, $product->name, $product->public_price, 1, []);

            return response()->json(Response::set(true, 'El producto de ha añaido al carrito'));
        } catch(\Exception $e) {
            return response()->json(Response::$fail);
        }
    }

    public function delete(Request $request) {
        try {
            Cart::remove($request->input('sku'));

            $cart = Cart::getContent();
            $subtotal = number_format(Cart::getSubTotal(), 2);
            $balance = Auth::user()->budget;
            $total = number_format(floatval($balance) - floatval($subtotal), 2);

            return response()->json(Response::set(true, 'El producto se ha eliminado del carrito exitosamente', compact('subtotal', 'balance', 'total')));
        } catch(\Exception $e) {
            return response()->json(Response::$fail);
        }
    }

    public function process(Request $request) {
        $cart = Cart::getContent();
        $subtotal = number_format(Cart::getSubTotal(), 2);
        $user = Auth::user();

        try {
            $order = Order::create([
                'user_id'       => $user->id,
                'full_name'     => $user->fullName,
                'address'       => $user->address,
                'amount'        => $subtotal
            ]);

            foreach ($cart as $item) {
                $product = Product::where('sku', $item->id)->first();
                $order->products()->attach($product, [
                    'price' => $item->price,
                    'quantity'=> $item->quantity
                ]);
            }

            $balance = $user->budget -= $subtotal;
            $user->save();

            Cart::clear();

            return response()->json(Response::set(true, 'Pedido creado correctamente', compact('order')));
        } catch(\Ecxeption $e) {
            return response()->json(Response::set(false, 'Hubo un error en el servidor'));
        }
    }
}
