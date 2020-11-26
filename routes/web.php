<?php

use App\Http\Controllers\AdminController;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('companies', CompanyController::class);

// Employee Routes
Route::resource('employees', EmployeeController::class);


// Admin Routes
Route::get('/users', [AdminController::class, 'users']);

Route::delete('/users/{user}', [AdminController::class, 'deleteUser']);
