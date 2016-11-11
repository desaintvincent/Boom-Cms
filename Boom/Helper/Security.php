<?php


namespace Boom\Helper;


class Security
{
    public static function crypt($value)
    {
        return sha1(md5($value));
    }
}