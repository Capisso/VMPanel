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


Route::get('/', array('before' => 'auth', function () {

}));

Route::get('/install/minion', function() {

   return View::make('static/install/minion', array(
       'master' => Config::get('salt.host')
   ));
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
        Route::resource('users', 'Admin\UserController');
        Route::resource('nodes', 'Admin\NodeController');
        Route::resource('regions', 'Admin\RegionController');
        Route::resource('addresses', 'Admin\AddressController');
        Route::controller('settings', 'Admin\SettingController');

        Route::group(array('prefix' => 'security'), function() {
            Route::get('/', 'Admin\Security\HomeController@getIndex');
            Route::resource('intrusion', 'Admin\Security\IntrusionController');
        });


    });
});

// Api Routes
Route::group(array('before' => 'api', 'prefix' => 'api'), function () {
    // v1
    Route::group(array('prefix' => 'v1'), function() {

        // Admin
        Route::group(array('prefix' => 'admin'), function() {
            Route::resource('users', 'ApiVersionOne\Admin\UserController');
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
