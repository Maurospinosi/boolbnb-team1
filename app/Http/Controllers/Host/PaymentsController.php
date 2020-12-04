<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree;

class PaymentsController extends Controller
{

    public function index(Request $request) {
        $data = $request->all();
        
        $request->validate([
            "amount" => "required"
        ]);

        $amount = $data["amount"];
        $url = $data["url"];

        return view('host.house.payment', compact("amount", "url"));
    }

    public function pay(Request $request) {
        $data = $request->all();
    
        $nonce = $data["payment_method_nonce"];
        $amount = $data["amount"];

        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '7fvbtn5hs7yp3kb2',
            'publicKey' => 'tdgs52j7pw8q4rfn',
            'privateKey' => '6962f031e145f78e15b08994df3e7dc2'
        ]);

        /* Use payment method nonce here */
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => True
            ]
        ]);

        $url = $data["url"];

        return redirect($url);
    
    }
}
