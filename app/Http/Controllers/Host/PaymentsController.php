<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\House;
use App\Sponsor;
use Carbon\Carbon;
use Braintree;

class PaymentsController extends Controller
{
    /* Funzione che prende
    un ammontare, un url e un house_id
    e restituisce la view dei pagamenti */
    
    public function index(Request $request) {


        // Prendiamo i dati e li salviamo in $data
        $data = $request->all();

        // Validiamo che ci sia un "amount"
        $request->validate([
            "amount" => "required"
        ]);
        
        // Salviamo i dati in variabili
        $amount = $data["amount"];
        $url = $data["url"];
        $house_id = $data["house_id"];
        
        // Indirizziamo l'utente alla pagina dei pagamenti passando i dati
        return view('host.house.payment', compact("amount", "url", "house_id"));
    }


    /* Funzione che prende
    il nonce di pagamento generato da Braintree,
    l'ammontare da pagare, un url e la house_id,
    effettua il pagamento,
    salva la sponsorizzazione nella migration
    e reindirizza all'url */

    public function pay(Request $request) {
        // Prendiamo i dati e li salviamo in $data
        $data = $request->all();

        // Salviamo i valori del nonce, dell'amount e dell'url in variabili
        $nonce = $data["payment_method_nonce"];
        $amount = $data["amount"];
        $url = $data["url"];
        $house_id = $data["house_id"];
        $house = House::where("id", $house_id)->get();

        // Creiamo un nuovo gateway
        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '7fvbtn5hs7yp3kb2',
            'publicKey' => 'tdgs52j7pw8q4rfn',
            'privateKey' => '6962f031e145f78e15b08994df3e7dc2'
        ]);

        // Creiamo una nuova transazione
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => True
            ]
        ]);

        // Prendiamo la casa con l'id passato da $data
        $house = House::where("id", $house_id)->first();

        // Rendiamo la casa automaticamente visibile quando viene sponsorizzata
        $house->visible == 1;

        // Prendiamo il valore della durata della sponsorizzazione
        $sponsorship = Sponsor::where("price", $amount)->first();

        // Prendiamo la data di oggi
        $now = Carbon::now();
        
        $end = Carbon::now()->addDays($sponsorship->duration);

        $house->sponsors()->sync([$sponsorship["id"] => ["start_date" => $now, "end_date" => $end]]);


        // Reindirizziamo nell'url della show in cui si trovava lo user
        return redirect($url);
    
    }
}
