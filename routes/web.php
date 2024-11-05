<?php

use App\Http\Controllers\Favorites\FavoritesController;
use App\Http\Controllers\Manutenzioni\ManutBrandsController;
use App\Http\Controllers\Manutenzioni\ManutCategorieController;
use App\Http\Controllers\Manutenzioni\ManutenzioniController;
use App\Http\Controllers\Manutenzioni\ManutFornitoriController;
use App\Http\Controllers\Manutenzioni\ManutOggettiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Quaderno\AppuntiController;
use App\Http\Controllers\Quaderno\ArgomentiController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', fn() => to_route('login'));

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('argomenti', ArgomentiController::class)->except(['show'])->parameters(['argomenti'=>'argomento']);
    Route::resource('appunti', AppuntiController::class)->except('show')->parameters(['appunti'=>'appunto']);

    Route::resource('favorites', FavoritesController::class)->except('create')->parameters(['favorites'=>'favorite']);
    Route::post('favorites/descrizione/modifica', [FavoritesController::class, 'modificaDescrizione'])->name('favorite.descrizione.modifica');
    Route::get('/favorite-export-json/{favorite}', [FavoritesController::class, 'exportJson'])->name('favorite.exportJson');
    Route::get('/favorite-make-bookmarks/{favorite}', [FavoritesController::class, 'makeBookmarks'])->name('favorite.makeBoomarks');

    Route::post('/favorites/{favorite}/link/{link}/update', [FavoritesController::class, 'updateLink'])->name('favorites.link.update');
    Route::get('/favorites/{favorite}/link/{link}/delete', [FavoritesController::class, 'deleteLink'])->name('favorites.link.delete');

    Route::resource('manutenzioni', ManutenzioniController::class)->except('show')->parameters(['manutenzioni'=>'manutenzione']);
    Route::resource('manutOggetti', ManutOggettiController::class)->except('create','show','edit')->parameters(['manutOggetti'=>'manutOggetto']);
    Route::resource('manutCategorie', ManutCategorieController::class)->except('create','show','edit')->parameters(['manutCategorie'=>'manutCategoria']);
    Route::resource('manutBrands', ManutBrandsController::class)->except('create','show','edit')->parameters(['manutBrands'=>'manutBrand']);
    Route::resource('manutFornitori', ManutFornitoriController::class)->except('show')->parameters(['manutFornitori'=>'manutFornitore']);
});

require __DIR__.'/auth.php';
