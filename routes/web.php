<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ObjetController;
use \App\Http\Controllers\UtilisateurController;
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


Route::resource('objet',ObjetController::class);
Route::resource('utilisateur',UtilisateurController::class);
Route::resource('enchere',EnchereController::class);

Route::get('/', [ObjetController::class,'index']);
