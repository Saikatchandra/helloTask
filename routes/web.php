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

//  Company Route
Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company.list');
Route::get('/company-list', [App\Http\Controllers\CompanyController::class, 'getCompany']);
Route::get('/company-create', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.create');
Route::get('/company-edit/{id}', [App\Http\Controllers\CompanyController::class, 'edit'])->name('company.edit');
Route::post('/company/store/{id?}', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store');
Route::post('/company/delete/{id?}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('company.delete');

// Employee Route
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.list');
Route::get('/employee-list', [App\Http\Controllers\EmployeeController::class, 'getCompany']);
Route::get('/employee-create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
Route::get('/employee-edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('/employee/store/{id?}', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::post('/employee/delete/{id?}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.delete');

// Route::resource('/company', App\Http\Controllers\CompanyController::class);

