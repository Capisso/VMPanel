<?php


use Illuminate\Config\Repository;

/**
 * Class Setting
 * This class handles site settings instead of actual app settings.
 */
class Setting {

    /**
     * The config repository instance.
     *
     * @var Illuminate\Config\Repository
     */
    protected $repository;


    public static function get($key) {
        return Config::get($key);
    }

    public static function set($key, $value) {
        // save to the db
        $config = DB::table('config');



        // save to config
        //Config::getLoader()->set($key, $value);

        // return
        return Config::get($key);
    }

}