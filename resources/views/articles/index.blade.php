@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="mb-5 mt-5">Nos articles</h2>
        <div class="row">
            @foreach($articles as $article)
                <div class="col col-4">
                    <div class="card mb-3">
                        <button type="button"
                                class="btn p-0 border-0 w-100 thumb-trigger"
                                data-original="{{ asset('image/'.$article->url) }}">
                            <img src="{{ asset('image/M'.$article->url) }}" name="{{ $article->url }}" class="card-img-top" alt="Aperçu du produit">
                        </button>
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->titre }}</h5>
                            <p class="card-text">{{ $article->description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $article->prix }} €</small></p>
                            <p class="card-text"><small class="text-body-secondary">{{ $article->qteStocks }} restants</small></p>
                            <form action="{{ route('cart.add') }}" method="post">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <input type="submit" value="Ajouter au panier">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Lightbox maison pour afficher l'image originale -->
    <style>
        #lightbox-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.75);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }
        #lightbox-overlay img {
            max-width: 90vw;
            max-height: 90vh;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }
        #lightbox-close {
            position: absolute;
            top: 16px;
            right: 16px;
        }
    </style>

    <div id="lightbox-overlay">
        <button id="lightbox-close" class="btn btn-light btn-sm">Fermer</button>
        <img id="lightbox-img" src="" alt="Image produit">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('lightbox-overlay');
            const img = document.getElementById('lightbox-img');
            const closeBtn = document.getElementById('lightbox-close');

            const open = (src) => {
                img.src = src;
                overlay.style.display = 'flex';
            };
            const close = () => {
                overlay.style.display = 'none';
                img.src = '';
            };

            document.querySelectorAll('.thumb-trigger[data-original]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const originalUrl = btn.getAttribute('data-original');
                    open(originalUrl);
                });
            });

            overlay.addEventListener('click', (e) => {
                if (e.target === overlay || e.target === closeBtn) {
                    close();
                }
            });
        });
    </script>
@endsection

