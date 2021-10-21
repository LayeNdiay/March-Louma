<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InviteControlleur;
use App\Http\Controllers\AddProductControlleur;
use App\Http\Controllers\Auth\RegisteredUserController;

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
    return view('welcome');
});
Route::get('/ajouter-produit',[AddProductControlleur::class,"addProduct"] )
        ->middleware(['auth']) ->name("addProduct");
Route::post('/ajouter-produit',[AddProductControlleur::class,"storeProduct"] )
        ->middleware(['auth'])
        ->name("storeProduct");
        
Route::get('/{slugUser}/regarder-article/{slugArticle}',[AddProductControlleur::class,"ViewMyProduct"] )
        ->middleware(['auth'])
        ->name("ViewMyProduct");

Route::get('/{slugUser}/modifier-article/{slugArticle}',[AddProductControlleur::class,"editMyProduct"] )
        ->middleware(['auth'])
        ->name("editMyProduct");
Route::post('/delete/{slugArticle}',[AddProductControlleur::class,"deleteProduct"] )
        ->middleware(['auth'])
        ->name("delete");

Route::post('/{slugUser}/modifier-article/{slugArticle}',[AddProductControlleur::class,"UpdateProduct"] )
        ->middleware(['auth'])
        ->name("UpdateProduct");




Route::get('/dashboard',[ Dashboard::class,"index"])->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';


Route::get('/{nomCategorie}',[InviteControlleur::class,"ViewCategorie"])
       ->name("ViewCategorie");

Route::get('/vendeur/{slugVendeur}',[InviteControlleur::class,"espaceVendeur"])
        ->name("espaceVendeur");

Route::get('/mise-a-jour-info/{slugUser}',[RegisteredUserController::class,"updateInfo"] )
        ->middleware(["auth"])
        ->name("updateInfo");

Route::post('/mise-a-jour-info/{slugUser}',[RegisteredUserController::class,"storeUpdateInfo"] )
        ->middleware(["auth"]);

Route::get('/article/{slugArticle}',[InviteControlleur::class,"viewArticle"] )
        ->name("ViewProduct");

Route::post('/search/{query}',[InviteControlleur::class,"rechercher"] )
        ->name("search");


Route::get('/{slugUser}/{slugArticle}',[AddProductControlleur::class,"ViewMyProduct"] )
        ->name("ViewProduct");


