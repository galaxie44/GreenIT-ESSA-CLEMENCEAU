<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/styles.css') }}">
    <title>Vente de maillots</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand actual" href="{{ route('home') }}">NBO Stare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('cart.show') }}">panier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">loginadmine</a>
                    </li>
                    @if(session('admin'))
                        <li id="ajouarticle" class="nav-item">
                            <a class="nav-link" href="{{ route('admin.articles.create') }}">ajouter un Article</a>
                        </li>
                        <li id="editArticle" class="nav-item">
                            <a class="nav-link" href="{{ route('admin.articles.index') }}">Edit un Article</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

