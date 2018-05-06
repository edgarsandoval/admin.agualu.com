<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConektaController extends Controller {
    protected $sandboxMode = true;
    public function __construct() {
        if($this->sandboxMode) {
            \Conekta\Conekta::setApiKey('key_6xus69Lfqx2HcTtEpDiqGg');
            \Conekta\Conekta::setApiVersion('2.0.0');
        } else {
            \Conekta\Conekta::setApiKey('key_6xus69Lfqx2HcTtEpDiqGg');
            \Conekta\Conekta::setApiVersion('2.0.0');
        }
    }
    public function payment(Request $request) {
        $user = Auth::user();

        $customer = $this->_makeCustomerArray($user);

        try {
            $order = \Conekta\Order::create([
                'livemode' => !$this->sandboxMode,
                'line_items' => [
                    [
                        'name' => 'Monedero electrónico (agualu.com)',
                        'unit_price' => $request->input('amount'),
                        'quantity' => 1
                    ]//first line_item
                ], //line_items,
                'shipping_lines' => [
                    array(
                        "amount" => 0,
                        "carrier" => "FEDEX"
                    )
                ],
                'currency' => 'MXN',
                'customer_info' => $customer, //customer_info
                "shipping_contact" => array(
                    "address" => array(
                        "street1" => "Calle 123, int 2",
                        "postal_code" => "06100",
                        "country" => "MX"
                    )//address
                ), //shipping_contact - required only for physical goods
                'charges' => [
                    [
                        'payment_method' => [
                            'type' => 'oxxo_cash'
                        ]//payment_method
                    ] //first charge
                ] //charges
            ]);

            session(['order' => $order]);
            return redirect()->route('oxxo_ticket', ['id' => $order->id]);

        } catch (\Conekta\ParameterValidationError $error){
            echo $error->getMessage();
        } catch (\Conekta\Handler $error){
            echo $error->getMessage();
        }
    }

    public function ticket($id = null) {
        $order = session('order');
        // TODO Validation and store of that charge

        return view('conekta.ticket', [
            'order' => $order
        ]);
    }

    private function _makeCustomerArray($user) {
        return [
            'name' => $user->full_name,
            'email' => $user->email,
            "phone" => "+5218181818181"
            // 'phone' => $user->phone
        ];
    }
}
