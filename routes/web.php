<?php

use App\Http\Controllers\CategorieController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ObjetController;
use \App\Http\Controllers\EnchereController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::put('/objet/{objet}/bid', [ObjetController::class, 'bid'])->name('objet.bid');

Route::resource('objet',ObjetController::class);
Route::resource('enchere',EnchereController::class);
Route::resource('categorie',CategorieController::class);

Route::get('/', [ObjetController::class,'index']);

Route::get('/feed', [ObjetController::class,'feed'])->name('objet.feed');
Route::get('/flush', [ObjetController::class,'flush'])->name('objet.flush');

Route::get('objet/{idCate}/categories', [ObjetController::class, 'index'])->name('objet.categorie');
//Route::post('/objet', [ObjetController::class, 'index']);

require __DIR__.'/auth.php';
