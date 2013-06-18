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

Route::get('/', function () {
    return Redirect::to('/user');
});

Route::controller('account', 'AccountController');

// Container for all auth required routes
Route::group(array('before' => 'auth'), function () {

    // User
    Route::group(array('prefix' => 'user', 'before' => 'group:Users'), function () {
        Route::get('/', function () {
            return View::make('user.index');
        });
    });

    // Reseller?

    // Admin
    Route::group(array('prefix' => 'admin', 'before' => 'group:Admins'), function () {
        Route::resource('users', 'Admin\UsersController');
    });
});

// Api Routes
Route::group(array('before' => 'api', 'prefix' => 'api'), function () {
    // v1
    Route::group(array('prefix' => 'v1'), function() {

        // Admin
        Route::group(array('prefix' => 'admin'), function() {
            Route::resource('users', 'ApiVersionOne\Admin\UsersController');
        });

        // User
        // @todo

    });

});


Route::group(array('prefix' => 'development'), function () {

    Route::get('createGroups', function () {
        Sentry::getGroupProvider()->create(array(
            'name' => 'Users'
        ));
        Sentry::getGroupProvider()->create(array(
            'name' => 'Resellers'
        ));
        Sentry::getGroupProvider()->create(array(
            'name' => 'Admins'
        ));
    });
});


