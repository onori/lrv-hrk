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

/**
 * not env=local force HTTPS!
 */
if ( ! App::environment('local')) {
    URL::forceSchema('https');
}

Route::get('/', function () {
    if ( !Auth::user() ) {
        return redirect('auth/login');
    } else {
        return redirect('home');
    }
});

/**
*   Auth & Register
*/
Route::group(['prefix' => 'auth'], function() {
    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::post('/login','Auth\AuthController@postLogin');

    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::post('auth/register', 'Auth\AuthController@postRegister');
});
