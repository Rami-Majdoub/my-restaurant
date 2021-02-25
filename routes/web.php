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

Route::get('/', [
    App\Http\Controllers\PagesController::class,
    'index'
])-> name('home');

Route::get('/dashboard', [
    App\Http\Controllers\HomeController::class,
    'index'
])-> name('dashboard');

Route::resource('products', 'App\Http\Controllers\ProductsController');
Route::resource('bills', 'App\Http\Controllers\BillsController');
Route::post('/bills/{id}/mark-as-paid', [
    App\Http\Controllers\BillsController::class,
    'mark_as_paid'
]);
Route::resource('tables', 'App\Http\Controllers\TablesController');

Auth::routes();

