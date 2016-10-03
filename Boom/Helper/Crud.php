<?php


namespace Boom\Helper;


class Crud
{
    public static $item;

    public static function make_form($conf, $item = null) {
        if ($item) {
            self::$item = (array) $item;
        }

        $html = '<form class="form-signin" enctype="multipart/form-data" action="#" method="post">';
        foreach ($conf as $key => $item) {
            if (method_exists(self::class, 'input_'.$item['type'])) {
                $function_name = 'input_'.$item['type'];
                $html .= self::$function_name($key, $item);
            } else {
                error('Type ' .$item['type']. ' doesn\'t exist! (yet)');
            }
        }
        $html .= '<div class="save"><button type="button" class="btn btn-primary" type="submit">Enregistrer les informations</button></div>';
        $html .= '</form>';

        return $html;
    }

    ///@todo mettre template
    public static function input_wysiwyg($key, $item)
    {
        $html = "<div class='{$item['type']}-field'>
            <div class='sub-title'>{$item['label']}</div>
            <textarea class='wysiwyg' name='{$key}' id='{$key}'>".self::$item[$key]."</textarea>

        </div>";
        return $html;
    }

    public static function input_text($key, $item)
    {
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                    <input type='text' class='form-control' value='" . self::$item[$key] . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    public static function input_password($key, $item)
    {
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                    <input type='password' class='form-control' value='" . self::$item[$key] . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    public static function input_email($key, $item)
    {
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                    <input type='email' class='form-control' value='" . self::$item[$key] . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    ///@todo mettre template
    public static function input_textarea($key, $item)
    {
        $html = "<div class='{$item['type']}-field'>
            <div class=\"sub-title\">{$item['label']}</div>
                <textarea name='{$key}' id='{$key}'>".self::$item[$key]."</textarea>
        </div>";
        return $html;
    }

    ///@todo mettre template
    public static function input_select($key, $item) {
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                        <select name='{$key}' id='{$key}'>";

        foreach ($item['value'] as $kval => $val) {
            if ($val == self::$item[$key]) {
                $html .= "<option value='{$kval}' selected>{$val}</option>";
            } else {
                $html .= "<option value='{$kval}'>{$val}</option>";
            }
        }
        $html .= "</select>
        </div>";

        return $html;
    }

    public static function input_checkbox($key, $item) {
        $html = "<div class='checkbox3 checkbox-inline checkbox-check checkbox-light'>
                    <input type='checkbox' name='{$key}' id='{$key}' " . (self::$item[$key] ? "checked " : " ") . self::required($item) . ">
                    <label for='{$key}'>{$item['label']}</label>
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