<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/companies', 'CompanyController@index');

Route::middleware('auth')->group(function(){
    Route::resource('companies', 'CompanyController')->except('index');

    // Employee Routes
    Route::resource('employees', 'EmployeeController');


    // Admin Routes

    Route::prefix('admin')->group(function(){
        Route::get('/', 'AdminController@dashboard');

        Route::get('/users', 'AdminController@users');
        Route::post('/users', 'AdminController@addAdminUser');

        Route::delete('/users/{user}', 'AdminController@deleteUser');
    });
});
