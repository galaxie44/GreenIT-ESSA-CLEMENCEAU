@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>Titre de l'article</p>
            <input type="text" name="titre" id="titre">
            <p>Description</p>
            <input type="text" name="descriptioion" id="descriptioion">
            <p>Prix</p>
            <input type="number" name="prix" id="prix">
            <p>Image</p>
            <input type="file" name="image" id="image">
            <p>Quantité</p>
            <input type="number" name="quantitee" id="quantitee"><br><br>
            <input type="submit" value="Envoyer" name="submit">
        </form>
    </div>
@endsection

