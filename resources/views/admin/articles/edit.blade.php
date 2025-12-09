@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.articles.update', $article->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <p>ID article *</p>
            <input type="text" name="idArticle" id="idArticle" value="{{ $article->id }}" readonly>
            <p>Titre de l'article *</p>
            <input type="text" name="titre" id="titre" value="{{ $article->titre }}">
            <p>Description *</p>
            <input type="text" name="descriptioion" id="descriptioion" value="{{ $article->description }}">
            <p>Prix *</p>
            <input type="number" name="prix" id="prix" value="{{ $article->prix }}">
            <p>Image</p>
            <input type="file" name="image" id="image">
            <p>Quantité *</p>
            <input type="text" name="Quantitee" id="Quantitee" value="{{ $article->qteStocks }}">
            <input type="submit" value="Envoyer" name="submit">
            <p>* obligatoire</p>
        </form>
    </div>
@endsection

