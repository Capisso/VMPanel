<?php

namespace Admin;

use View;
use Config;
use Input;
use Setting;
use Redirect;

class SettingController extends BaseController {

    public function getIndex() {

        Setting::set('site.themes', array(
            'default_capisso' => 'Capisso Default'
        ));
        Setting::set('site.theme.user', 'default');
        Setting::set('salt.credentials', array('username' => '', 'password' => ''));
        Setting::set('salt.auth_type', 'pam');
        Setting::set('salt.api_certificate_path', false);

        $auth = Setting::get('salt.credentials');

        $bootswatch = json_decode(file_get_contents('http://api.bootswatch.com/'), true);
        $skins = array();
        foreach($bootswatch['themes'] as $theme) {
            $skins[$theme['name']] = $theme['name'];
        }


        return View::make('admin/setting/index', array(
            'auth' => $auth,
            'bootswatch' => $bootswatch['themes'],
            'bootswatchSkins' => $skins,
            'title' => 'Settings Manager'
        ));
    }

    public function putUpdate() {
        // Handle the rest of the settings

        $fields = Input::all();
        foreach($fields as $key => $value) {
            // Check if it's a private key
            if(\Str::startsWith($key, '_')) continue;
            // Void unchanged/unset values.
            if($value == '') continue;

            // Handle salt
            if($key == 'salt') {
                $auth = Config::get('salt.credentials');
                foreach($value as $k => $v) {
                    if($k == 'auth_username')
                        $auth['username'] = $v;
                    if($k == 'auth_password' && $v != '')
                        $auth['password'] = $v;

                    Config::set($k, $v);
                }
                dd($value);
            }



            $key = str_replace('_', '.', $key);

            Setting::set($key, $value);
        }



        return Redirect::action('Admin\SettingController@getIndex');

    }

}
