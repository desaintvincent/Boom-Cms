<?php


namespace Boom\Helper;


class Token
{
    public static function generate($item)
    {
        $id = isset($item->id) ? $item->id : isset($item['id']) ? $item['id'] : uniqid();
        $time = time();

        return sha1(md5($id . $time));
    }
}