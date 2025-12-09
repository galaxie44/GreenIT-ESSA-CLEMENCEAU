<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('qteStocks', '>', 0)->get();

        return view('articles.index', compact('articles'));
    }
}

