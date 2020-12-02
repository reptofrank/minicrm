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


Route::get('/user', 'HomeController@getUser')->name('get_user');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin', 'AdminController@dashboard')->middleware(['auth', 'can:admin'])->name('dashboard');

Route::prefix('api')->middleware('auth')->group(function(){
    Route::resource('companies', 'CompanyController')->except('index');

    // Employee Routes
    Route::resource('employees', 'EmployeeController');


    // Admin Routes

    Route::prefix('admin')->middleware('can:admin')->group(function(){

        Route::get('/users', 'AdminController@users');
        Route::post('/users', 'AdminController@addAdminUser');

        Route::delete('/users/{user}', 'AdminController@deleteUser');
    });
});

Route::get('/{page?}', 'HomeController@index')->name('home');

