<?php

use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('home');

Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/retirer', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/panier', [CartController::class, 'show'])->name('cart.show');

Route::get('/paiement', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/paiement', [PaymentController::class, 'process'])->name('payment.process');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');
});
