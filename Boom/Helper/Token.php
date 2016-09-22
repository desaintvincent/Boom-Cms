<?php


namespace Boom\Helper;


class Token
{
    public static function generate($item)
    {
        $id = uniqid();
        if (is_object($item) && isset($item->id)) {
        	$id = $item->id;
        } elseif (is_array($item) && isset($item['id'])) {
            $id = $item['id'];
        }
        $time = time();

        return Security::crypt($id . $time);
    }
}