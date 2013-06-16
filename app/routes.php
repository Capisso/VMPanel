<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('account', 'AccountController');

// Container for all auth required routes
Route::group(array('before' => 'auth'), function() {

    // User
    Route::group(array('prefix' => 'user', 'before' => 'group:Users'), function() {
        Route::get('/', function() {
            return View::make('user.index');
        });
    });

    // Reseller?

    // Admin
    Route::group(array('prefix' => 'admin', 'before' => 'group:Admins'), function() {
        Route::get('', function() {
        });
    });


});



Route::group(array('prefix' => 'development'), function() {
    if(App::environment() != 'local') die('Development only');

    Route::get('createGroups', function() {
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Users'
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Resellers'
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admins'
        ));
    });

});