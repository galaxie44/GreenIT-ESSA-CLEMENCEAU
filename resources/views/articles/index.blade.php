@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="mb-5 mt-5"> Nos articles</h2>
        <div class="row">
            @foreach($articles as $article)
                <div class="col col-4">
                    <div class="card mb-3">
                        <img src="{{ asset('image/M'.$article->url) }}" name="{{ $article->url }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->titre }}</h5>
                            <p class="card-text">{{ $article->description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $article->prix }} €</small></p>
                            <p class="card-text"><small class="text-body-secondary">{{ $article->qteStocks }} Restant</small></p>
                            <form action="{{ route('cart.add') }}" method="post">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <input type="submit" value="ajouter au panier">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

