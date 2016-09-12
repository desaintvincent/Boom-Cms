<?php


namespace Boom\Helper;


class Crud
{
    public static $item;

    public static function make_form($conf, $item = null) {
        if ($item) {
            self::$item = $item;
        }
        $html = "";
        foreach ($conf as $key => $item) {
            if (method_exists(self::class, 'input_'.$item['type'])) {
                $function_name = 'input_'.$item['type'];
                $html .= self::$function_name($key, $item);
            } else {
                $html .= '<div class="warning" style="border: 1px solid red; padding: 10px; color: red">Type ' .$item['type']. ' doesn\'t exist! (yet)</div>';
            }
        }

        return $html;
    }

    public static function input_text($key, $item)
    {
        $html = "<div class='{$item['type']}-field'>
                    <label for='{$key}'>{$item['label']}</label>
                    <input type='text' value='" . self::$item[$key] . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    public static function required($item) {
        if (isset($item['option']['required'])) {
            return "required";
        } else {
            return '';
        }
    }
}