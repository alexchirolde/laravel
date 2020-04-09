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

Route::group( ['prefix' => 'backend'], function () {

    Route::get('/', 'Backend\DashboardController@index')->name('dashboard');
    Route::get('/dashboard',function () {
        return redirect()->route('dashboard');
    });

    // User Administration
    Route::group(['prefix' => 'users'], function () {
        //user creation
        Route::post('create', 'Backend\UserAdministrationController@createUser')->middleware('can:create users')->name('backend.users.createUser');
        Route::get('create', 'Backend\UserAdministrationController@displayCreateUsersForm')->middleware('can:create users')->name('backend.users.createForm');
        Route::get('list', 'Backend\UserAdministrationController@displayListUsersForm')->middleware('can:read users')->name('backend.users.readUsersForm');
        Route::post('edit/{id}', 'Backend\UserAdministrationController@editUser')->middleware('can:edit users')->name('backend.users.editUser');
        Route::get('edit/{id}', 'Backend\UserAdministrationController@displayEditUsersForm')->middleware('can:edit users')->name('backend.users.editUsersForm');


    });

    // Auth
    Route::group([], function () {

        // Login
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::any('logout', 'Auth\LoginController@logout')->name('logout');
        // Password resest
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    });

});


Route::get('/', function () {
    return dd('hier entsteht das frontend');
});


