@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>titre de l'article</p>
            <input type="text" name="titre" id="titre">
            <p>descriptioion</p>
            <input type="text" name="descriptioion" id="descriptioion">
            <p>prix </p>
            <input type="number" name="prix" id="prix">
            <p>image</p>
            <input type="file" name="image" id="image">
            <p>Quantitee</p>
            <input type="number" name="quantitee" id="quantitee"><br><br>
            <input type="submit" value="envoier" name="submit">
        </form>
    </div>
@endsection

