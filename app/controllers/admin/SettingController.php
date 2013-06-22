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

        return View::make('admin/setting/index', array(
            'title' => 'Settings Manager'
        ));
    }

    public function putUpdate() {

        // Figure out what key we need to update.
        $fields = Input::all();
        foreach($fields as $key => $value) {
            // Check if it's a private key
            if(\Str::startsWith($key, '_')) continue;
            // Void unchanged/unset values.
            if($value == '') continue;

            $key = str_replace('_', '.', $key);

            Setting::set($key, $value);
        }

        return Redirect::action('Admin\SettingController@getIndex');

    }

}
