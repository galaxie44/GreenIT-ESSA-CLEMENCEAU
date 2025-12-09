<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'article_id' => 'required|integer',
        ]);

        $id = (int) $request->input('article_id');
        $cart = session()->get('panier', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        session()->put('panier', $cart);

        return back();
    }

    public function remove(Request $request): RedirectResponse
    {
        $request->validate([
            'article_id' => 'required|integer',
        ]);

        $id = (int) $request->input('article_id');
        $cart = session()->get('panier', []);

        if (isset($cart[$id])) {
            $cart[$id] = max(0, $cart[$id] - 1);
            if ($cart[$id] === 0) {
                unset($cart[$id]);
            }
            session()->put('panier', $cart);
        }

        return back();
    }

    public function show(): View
    {
        $cart = session()->get('panier', []);
        $items = [];
        $total = 0;

        if (!empty($cart)) {
            $articles = Article::whereIn('id', array_keys($cart))->get();
            foreach ($articles as $article) {
                $qty = $cart[$article->id] ?? 0;
                $items[] = [
                    'article' => $article,
                    'qty' => $qty,
                    'line_total' => $qty * $article->prix,
                ];
                $total += $qty * $article->prix;
            }
        }

        return view('cart.show', compact('items', 'total'));
    }
}

