<?php

namespace App\Http\Controllers;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    public function index()
    {
        return view('abonnement');
    }

    public function pay()
    {
        FedaPay::setApiKey(config('services.fedapay.secret'));
FedaPay::setEnvironment(config('services.fedapay.env'));


        $transaction = Transaction::create([
            'description' => 'Abonnement Culture Bénin',
            'amount' => 2000, // montant en FCFA
            'currency' => ['iso' => 'XOF'],
            'callback_url' => route('payment.callback'),
            'customer' => [
                'email' => Auth::user()->email,
            ],
        ]);

        return redirect($transaction->generateCheckoutUrl());
    }

    public function callback(Request $request)
{
    $transactionId = $request->transaction_id;

    FedaPay::setApiKey(config('services.fedapay.secret'));
FedaPay::setEnvironment(config('services.fedapay.env'));


    $transaction = Transaction::retrieve($transactionId);

    if ($transaction->status === 'approved') {
        $user = Auth::user();

        $user->subscription()->updateOrCreate([], [
            'status' => 'active',
            'expires_at' => now()->addMonth() // abonnement d’un mois
        ]);

        return redirect()->route('home')->with('success', 'Paiement réussi, votre abonnement est actif.');
    }

    return redirect()->route('subscribe')->with('error', 'Paiement échoué.');
}



}
