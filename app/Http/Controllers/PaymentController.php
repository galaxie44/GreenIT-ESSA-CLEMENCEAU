<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function show(): View
    {
        return view('payment.form');
    }

    public function process(Request $request): RedirectResponse
    {
        $request->validate([
            'numcatre' => 'required|string',
            'numCrypto' => 'required|string',
            'dateexpeiration' => 'required|date',
        ]);

        $card = str_replace(' ', '', $request->input('numcatre'));
        $crypto = str_replace(' ', '', $request->input('numCrypto'));
        $expiration = Carbon::parse($request->input('dateexpeiration'));

        $cart = session()->get('panier', []);

        if (strlen($card) === 16 && strlen($crypto) === 3 && $expiration->diffInDays(Carbon::now(), false) <= -90) {
            foreach ($cart as $articleId => $qty) {
                Article::where('id', $articleId)->decrement('qteStocks', $qty);
            }
            session()->forget('panier');
            return back()->with('success', 'merci de votre achat');
        }

        return back()->withErrors(['payment' => 'pas ok veuiller ressayer']);
    }
}

