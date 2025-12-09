@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="mb-5 mt-5"> Nos articles</h2>
        <div class="row">
            @foreach($articles as $article)
                <div class="col">
                    <div class="card mb-3">
                        <img src="{{ asset('image/'.$article->url) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->titre }}</h5>
                            <p class="card-text">{{ $article->description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $article->prix }} €</small></p>
                            <p class="card-text"><small class="text-body-secondary">{{ $article->qteStocks }} Restant</small></p>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary mt-2 btnModif">Modifier</a><br>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btnSupp" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?');">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

