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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index']);
Route::get('/company-create', [App\Http\Controllers\CompanyController::class, 'create']);
Route::post('/company-store', [App\Http\Controllers\CompanyController::class, 'store']);

