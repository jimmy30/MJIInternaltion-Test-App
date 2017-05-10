<?php

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


//Auth::routes();

Route::group(['namespace' => 'Frontend'], function () {
    
    Route::get('/', function () {
        return view('welcome');
    });

    
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
        Route::get('/password.request', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);

        Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
        Route::post('/register', 'Auth\RegisterController@register');
        Route::post('/password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('/password/reset{token?}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
        Route::post('/password.request', ['as' => 'password.request', 'uses' => 'Auth\ResetPasswordController@reset']);
    });
    
    Route::group(['middleware' => 'auth.basic'], function () {
        Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index'])->name('home');
        Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    });
    
});


Route::group(['namespace' => 'Admin'], function () {
    
    Route::get('/admin', function () {
        return redirect('/admin/login');
    });
    
    Route::group(['middleware' => 'admin_guest'], function () {
        Route::get('/admin/login',  ['as' => 'admin/login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('/admin/login', ['as' => 'admin/login', 'uses' => 'Auth\LoginController@login']);
    });

    
    Route::group(['middleware' => 'admin_auth'], function () {
        Route::get('/admin/home', ['as' => 'admin/home', 'uses' => 'HomeController@index'])->name('home');
        Route::post('/admin/logout', ['as' => 'admin/logout', 'uses' => 'Auth\LoginController@logout']);
        
        Route::get('/admin/users', ['as' => 'admin/users', 'uses' => 'UserController@index']);
        Route::get('/admin/add-user', ['as' => 'admin/add-user', 'uses' => 'UserController@add']);
        Route::post('/admin/add-user', 'UserController@postAdd');
        Route::get('/admin/edit-user/{id}', ['as' => 'admin/edit-user', 'uses' => 'UserController@edit']);
        Route::put('/admin/edit-user/{id}', ['as' => 'admin/edit-user', 'uses' => 'UserController@postEdit']);
        Route::get('/admin/delete-user/{id}', ['as' => 'admin/delete-user', 'uses' => 'UserController@delete']);
    });

});



