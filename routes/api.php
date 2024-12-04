<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PanierItemController;
use App\Http\Controllers\ProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ClientController::class)->group(function(){
    Route::get('clients','index');
    Route::post('clients','store');
    Route::get('clients/{id}','show');
    Route::put('clients-update/{id}','update');
    Route::delete('clients-delete/{id}','destroy');
});

Route::controller(CategorieController::class)->middleware('auth')->group(function(){
    Route::get('categories','index');
    Route::post('categories','store');
    Route::get('categories/{id}','show');
    Route::post('categories-update/{id}','update');
    Route::delete('categories-delete/{id}','destroy');
});

Route::controller(PanierController::class)->group(function(){
    Route::get('panier-produits','index');
    Route::post('panier-produits','store');
    // Route::get('categories/{id}','show');
    Route::put('panier-produits/{id}','update');
    Route::delete('panier-produits-delete/{id}','destroy');
    Route::put('incrementation/{id}','incrementation');
    Route::put('decrementation/{id}','decrementation');
});

Route::controller(CommandeController::class)->group(function(){
    Route::get('commandes','index');
    Route::get('ligne-commandes','ligneCommandes');
    Route::post('commandes-store','store');
    // Route::get('categories/{id}','show');
    // Route::put('panier-produits/{id}','update');
    // Route::delete('panier-produits-delete/{id}','destroy');
});

Route::controller(ProduitController::class)->middleware('auth')->group(function(){
    Route::get('produits','index');
    Route::post('produits','store');
    Route::get('produits/{id}','show');
    Route::post('produits-update/{id}','update');
    Route::delete('produits-delete/{id}','destroy');
});

Route::controller(AlbumController::class)->group(function(){
    Route::get('albums','index');
    Route::post('albums','store');
    Route::get('albums/{id}','show');
    Route::post('albums-update/{id}','update');
    Route::delete('albums-delete/{id}','destroy');
});

Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login-store',[AuthController::class,'login_store']);
Route::post('register',[AuthController::class,'register']);
Route::post('logout',[AuthController::class,'logout'])->middleware('auth');
Route::post('refresh',[AuthController::class,'refresh']);
Route::post('me',[AuthController::class,'me']);



