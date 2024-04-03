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
        // 'canRegister' => Route::has('register'),
        'canRegister' => false,
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

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])
        ->name('users.index')
        ->middleware('can:user-management');

    Route::post('users/enable/{id}', [\App\Http\Controllers\UserController::class, 'enable'])
        ->name('users.enable')
        ->middleware('can:user-management');

    Route::post('users/disable/{user}', [\App\Http\Controllers\UserController::class, 'disable'])
        ->name('users.disable')
        ->middleware('can:user-management');
});

Route::prefix(config('quote_api.quotes_api_prefix'))
    ->middleware(config('quote_api.quotes_api_middlewares'))
    ->group(function () {

        Route::resource('quotes', \App\Http\Controllers\QuoteController::class)->middleware('can:user-favorites');

        Route::post('quotes/favorites', [\App\Http\Controllers\QuoteController::class, 'favorite'])
            ->name('quotes.favorite');

        Route::get('quotes/favorites/{user}', [\App\Http\Controllers\QuoteController::class, 'getFavoritesByUser'])
            ->name('quotes.favorites');

        Route::delete('quotes/favorite/{quote}', [\App\Http\Controllers\QuoteController::class, 'deleleFavorite'])
            ->name('quotes.favorites.delete');
});
