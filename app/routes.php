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

Route::get('/test', function() {



    $cpu = Salty::against('*')->module('status')->cpuinfo()->getResults(false);
    //$cpu = Salty::against('*')->module('test')->collatz(5)->getResults(true);

    var_dump($cpu);
});

/**
 * This is a temporary implementation.
 */
Route::get('/install/minion', function() {
    define('CR', "\r");          // Carriage Return: Mac
    define('LF', "\n");          // Line Feed: Unix
    define('CRLF', "\r\n");      // Carriage Return and Line Feed: Windows
    define('BR', '<br />' . LF); // HTML Break
        
    $file = file_get_contents(app_path().'/views/static/install/minion.sh');
    $s = str_replace(CRLF, LF, $file);
    $s = str_replace(CR, LF, $s);
    // Don't allow out-of-control blank lines
    $file = preg_replace("/\n{2,}/", LF . LF, $s);

    $master = Config::get('salt.host');
    $file = str_replace('$$MASTER$$', $master, $file);

    return Response::make($file, 200, array('Content-Type' => 'text/x-shellscript'));

});

Route::controller('account', 'AccountController');

// Container for all auth required routes
Route::group(array('before' => 'auth'), function () {

    // @todo set theme

    Route::get('/', 'HomeController@getIndex');

    // User
    Route::group(array('prefix' => 'user', 'before' => 'group:Users'), function () {
        Route::get('/', function () {
            return View::make('user.index');
        });

        Route::resource('servers', 'User\ServerController');
    });

    // Reseller?

    // Admin
    Route::group(array('prefix' => 'admin', 'before' => 'group:Admins'), function () {
        Route::get('/', 'Admin\HomeController@getIndex');
        Route::resource('users', 'Admin\UserController');
        Route::resource('nodes', 'Admin\NodeController');
        Route::resource('regions', 'Admin\RegionController');
        Route::resource('addresses', 'Admin\AddressController');
        Route::resource('plans', 'Admin\PlanController');
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
            Route::resource('nodes', 'ApiVersionOne\Admin\NodeController');
            Route::resource('regions', 'ApiVersionOne\Admin\RegionController');
            Route::resource('plans', 'ApiVersionOne\Admin\PlanController');
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
