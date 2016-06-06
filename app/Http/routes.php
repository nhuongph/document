<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});

//User
Route::get('/logout', ['uses' => 'UserController@getLogout', 'as' => 'getLogout']);

Route::get('/login', ['uses' => 'UserController@getLogin', 'as' => 'getLogin']);
Route::post('/login', ['uses' => 'UserController@postLogin', 'as' => 'postLogin']);

Route::get('/register', ['uses' => 'UserController@getRegister', 'as' => 'getRegister']);
Route::post('/register', ['uses' => 'UserController@postRegister', 'as' => 'postRegister']);
Route::get('/createAccount/{token}', ['uses' => 'UserController@createAccount', 'as' => 'createAccount']);

Route::get('/update/{username}', ['uses' => 'UserController@getUpdate', 'as' => 'getUpdate']);
Route::post('/update', ['uses' => 'UserController@postUpdate', 'as' => 'postUpdate']);

Route::controllers(
    [
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController'
    ]
);

//Walltet 
Route::get('/home', ['uses' => 'WalletsController@getWallet', 'as' => 'home']);
Route::get('/addwallet', ['uses' => 'WalletsController@getAddWallet', 'as' => 'addWallet']);
Route::post('/addwallet', ['uses' => 'WalletsController@postAddWallet', 'as' => 'postWallet']);
Route::post('/addwallet', ['uses' => 'WalletsController@postAddWallet', 'as' => 'postWallet']);
Route::get('/currentwallet/{id}', ['uses' => 'WalletsController@setCurrentWallet', 'as' => 'setCurrentWallet']);
Route::get('/updatewallet/{id}', ['uses' => 'WalletsController@getUpdateWallet', 'as' => 'getUpdateWallet']);
Route::post('/updatewallet', ['uses' => 'WalletsController@postUpdateWallet', 'as' => 'postUpdateWallet']);
Route::get('/deletewallet/{id}', ['uses' => 'WalletsController@getDeleteWallet', 'as' => 'getDeleteWallet']);