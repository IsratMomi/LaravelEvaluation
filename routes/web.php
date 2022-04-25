<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-product',[HomeController::class,'addProduct'])->name('product-add');
Route::get('fetch-products',[HomeController::class,'fetchProduct']);
Route::delete('delete-product/{id}',[HomeController::class,'deleteProduct']);
Route::post('search',[SearchController::class,'search'])->name('search');
