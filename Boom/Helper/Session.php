<?php


namespace Boom\Helper;


class Session
{
    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        if (isset($_SESSION[$name])) {
        	return $_SESSION[$name];
        }

        return null;
    }

    public static function delete($name)
    {
        if (isset($_SESSION[$name])) {
        	unset($_SESSION[$name]);
        }
    }
}