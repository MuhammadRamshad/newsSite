<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SitemapController;

Route::get('/robots.txt', function () {
    return response(file_get_contents(base_path('robots.txt')), 200)
        ->header('Content-Type', 'text/plain');
});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::view('/about', 'about')->name('about');
Route::view('/privacy-policy', 'privacyPolicy')->name('privacyPolicy');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/author/{slug}', [AuthorController::class, 'show'])->name('author.show');
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Article detail — must be last
Route::get('/{category}/{slug}', [HomeController::class, 'show'])->name('news.show');
