<?php


namespace Boom\Helper;


class Data
{
    public static $datas;

    public function __construct() {

    }

    public static function load($name) {
        if (!isset(static::$datas[$name])) {
            $path = './Apps' . DS . 'Admin' . DS . 'Datas' . DS . $name . '.json';
            if (file_exists($path)) {
                static::$datas[$name] = json_decode(file_get_contents($path));
            }
        }
    }

    public static function get($name) {
        self::load($name);
        if (isset(static::$datas[$name])) {
            return static::$datas[$name];
        }
    }

    public static function set($name, $new_datas) {
        if (isset(static::$datas[$name])) {
            static::$datas[$name] = $new_datas;

            $path = BASE_URL . DS . 'Apps' . DS . 'Admin' . DS . 'Datas' . DS . $name . '.json';
            $fp = fopen($path, 'w');
            if ($fp) {
                fwrite($fp, json_encode($new_datas));
                fclose($fp);
            }
        }
    }
}