<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function history() {
        $orders = Auth::user()->orders;

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $order = Order::findOrFail($id);
        $status = Order::getPossibleEnumValues('status');

        return view('orders.edit', compact('order', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        if($order->status == 'Cancelado') {
            $user = $order->user;

            $user->addPayment('Reembolso por cancelación de pedido - PEDIDO NO.' . $id, floatval($order->amount));

            return redirect()->route('orders')
            ->with('success_message', '¡Pedido #' . $order->id . ' editado correctamente!')
            ->with('info_message', 'Se ha realizado el reembolso de puntos correspondiente al asociado');
        }

        return redirect()->route('orders')
            ->with('success_message', '¡Pedido #' . $order->id . ' editado correctamente!');
    }
}
