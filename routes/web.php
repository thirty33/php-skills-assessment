<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\PageController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('quotes', \App\Http\Controllers\QuoteController::class);

    Route::post('quotes/add-favorite', [\App\Http\Controllers\QuoteController::class, 'favorite'])
        ->name('quotes.favorite');

    Route::get('quotes/get-favorites/{user}', [\App\Http\Controllers\QuoteController::class, 'getFavoritesByUser'])
        ->name('quotes.favorites');

    Route::delete('quotes/delete-favorite/{quote}', [\App\Http\Controllers\QuoteController::class, 'deleleFavorite'])
        ->name('quotes.favorites.delete');
});
