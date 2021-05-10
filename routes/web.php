<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('details/{id}', 'HomeController@details')->where('id','[0-9]+');
Route::get('carrinho', 'HomeController@carrinho');
Route::any('checkout', 'AuthController@checkout');
Route::any('transacao', 'AuthController@transac');
Route::get('profile', 'AuthController@profile');
Route::get('compras', 'AuthController@profile');
Route::post('profile', 'AuthController@updateprofile');

Route::any('itens/{id}', 'AuthController@itens')->where('id','[0-9]+');;

