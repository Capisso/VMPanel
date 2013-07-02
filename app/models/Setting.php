<?php

/**
 * Class Setting
 * This class handles site settings instead of actual app settings.
 */
class Setting {

    public static function get($key) {
        return Config::get($key);
    }

    public static function set($key, $value) {

        // save to config
        Config::getLoader()->set($key, $value);
        Config::set($key, $value);

        // return
        return Config::get($key);
    }

}