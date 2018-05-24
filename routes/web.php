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

Route::get('/', 'Auth\LoginController@index')->name('home');

Auth::routes();

Route::get('/password/reset', 'Auth\ResetPasswordController@index');
Route::post('/password/send', 'Auth\ResetPasswordController@send');

//Trocar senha no primeiro access
Route::resource('newpass', 'NewPassController')->middleware('auth');

Route::group(['middleware' => ['first', 'auth']], function () {

    //Rota da página inicial
    Route::get('/home', 'HomeController@index')->name('home');

    //Rotas para pessoas
    Route::resource('profiles', 'ProfileController');

    Route::get('usuario/senha', 'UserController@changepassword');

    Route::patch('usuario/senha/{id}', 'NewPassController@updatepassword');
});

Route::group(['middleware' => 'admin'], function() {

    //Rotas para estados
    Route::resource('estados', 'EstadoController');

    //Rotas para cidades
    Route::resource('cidades', 'CidadeController');
    
    //Rotas para usuários
    Route::resource('users', 'UserController');//->only('index');

    Route::put('user/{id}/reset', 'UserController@reset');

    Route::get('user/infos', 'AuthUserController@edit');

    Route::patch('user/{id}', 'AuthUserController@update');
});