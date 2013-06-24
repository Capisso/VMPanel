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

Route::get('/testing', function() {

    /*
     * This is a good base for what our Salty library will be doing.
     */

    $ip = Config::get('salt.ip');
    $port = Config::Get('salt.port');
    $username = Config::get('salt.username');
    $password = Config::get('salt.password');

    $params = array(
        'client' => 'local',
        'username' => $username,
        'password' => $password,
        'eauth' => 'pam',
        'tgt' => 'debian',
        'fun' => 'virt.freemem',
        //'arg' => 'name=test_vm cpu=2 mem=512 image=salt://images/ubuntu1204.tar'
    );


    //set up a connection variable for the page you will post data to
    $curl_connection = curl_init("https://$ip:$port/run");

//curl basic setup
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

//$_POST variables to pass
    foreach($params as $key => $value) {
        $post_items[] = "$key=$value";
    }

//format the $post_items into a string
    $post_string = implode ('&', $post_items);

//send the $_POST data to the new page
    curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
    $result = curl_exec($curl_connection);
    curl_close($curl_connection);

    $array = json_decode($result, true);

    foreach($array['return'][0] as $vm => $output) {
        echo "<h2>$vm</h2><br>";

        echo "<pre>";
        print_r($output);
        echo "</pre>";
    }

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
