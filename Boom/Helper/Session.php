<?php


namespace Boom\Helper;


class Session
{
    public static function set($name, $value)
    {
        $_SERVER[$name] = $value;
    }

    public static function get($name)
    {
        if (isset($_SESSION[$name])) {
        	return $_SESSION[$name];
        }

        return null;
    }
}