<?php
/**
 * Created by PhpStorm.
 * User: destvincent
 * Date: 25/10/16
 * Time: 13:15
 */

namespace Boom\Helper;


class Auth
{
    public static function connected()
    {

        return Session::get("token");
    }
}