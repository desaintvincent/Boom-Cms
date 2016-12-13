<?php


namespace Boom\Helper;


class Crud
{
    public static $item;

    public static function make_form($conf, $item = null) {
        if ($item) {
            self::$item = $item;
        }
        $html = '<form class="form" enctype="multipart/form-data" action="" method="post">';
        foreach ($conf as $key => $item) {
            if (method_exists(self::class, 'input_'.$item['type'])) {
                $function_name = 'input_'.$item['type'];
                $html .= self::$function_name($key, $item);
            } else {
                error('Type ' .$item['type']. ' doesn\'t exist! (yet)');
            }
        }
        $html .= '<div class="save"><input class="btn btn-primary" type="submit" value="Enregistrer les informations"</input></div>';
        $html .= '</form>';

        return $html;
    }

    ///@todo mettre template
    public static function input_wysiwyg($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
            <div class='sub-title'>{$item['label']}</div>
            <textarea class='wysiwyg' name='{$key}' id='{$key}'>".$val."</textarea>

        </div>";
        return $html;
    }

    public static function input_text($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}";
        $html .= self::help($item);
        $html .= "</div>
                    <input type='text' class='form-control' value='" . $val . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    public static function input_color($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}";
        $html .= self::help($item);
        $html .= "</div>
                    <input class='form-control color_picker' value='" . $val . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        $html = '<input type="text" maxlength="6" size="6" class="colorpicker" value="00ff00" />';
        return $html;
    }

    public static function input_number($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                    <input type='number' step='any' class='form-control' value='" . $val . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    public static function input_slug($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>";
        $data_slug = empty($val) ? "data-slug='{$item['options']['linked']}'" : '';
        $class_slug = empty($val) ? 'link-slug' : '';
        $html .= "<input type='text' class='form-control {$class_slug}' value='{$val}' name='{$key}' id='{$key}' {$data_slug}>";
        $html .= "</div>";
        return $html;
    }

    public static function input_password($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                    <input type='password' class='form-control' value='" . $val . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    public static function input_email($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                    <input type='email' class='form-control' value='" . $val . "' name='{$key}' id='{$key}' " . self::required($item) . ">
                </div>";
        return $html;
    }

    ///@todo mettre template
    public static function input_textarea($key, $item)
    {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class='{$item['type']}-field'>
            <div class=\"sub-title\">{$item['label']}";
        $html .= self::help($item);
        $html .= "</div>
                <textarea name='{$key}' id='{$key}'>".$val."</textarea>
        </div>";
        return $html;
    }

    ///@todo mettre template
    public static function input_select($key, $item) {
        $html = "<div class='{$item['type']}-field'>
                    <div class='sub-title'>{$item['label']}</div>
                        <select class='form-control' name='{$key}' id='{$key}'>";

        foreach ($item['value'] as $kval => $val) {
            if (isset(self::$item->{$key}) && $kval == self::$item->{$key}) {
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
        $html = "<div class='checkbox-custom'>
                    <div class='sub-title'>{$item['label']}</div>
                    <input type='checkbox' class='cbx hidden' name='{$key}' id='{$key}' " . (isset(self::$item) && self::$item->{$key} ? "checked " : " ") . self::required($item) . ">
                    <label for='{$key}' class='lbl'>";
        $html .= self::help($item);
        $html .= "</label>
                </div>";
        return $html;
    }

    public static function input_image($key, $item) {
        $val = isset(self::$item->{$key}) ? self::$item->{$key} : '';
        $html = "<div class=\"{$item['type']}-field\">
                    <div class=\"sub-title\">{$item['label']}</div>";
        if (!empty($val)) {
            $text_preview = __('Image actuelle');
            $html .= "<div class=\"preview\">
                        <span class='text'>{$text_preview}:</span>
                        <span class='img'><img src=\"{$val}\"></span>
                      </div>";
            $fake_item = $item;
            $fake_item['label'] = __('Supprimer l\'image');
            $html .= self::input_checkbox($key.'_delete', $fake_item);
        }
        $text_pick = __('Selectionner un fichier');
        $html .= "<input name=\"{$key}\" type=\"file\" id=\"{$key}\" class=\"input-file\"/>";
        $html .= "<label for=\"{$key}\" class=\"btn btn-tertiary js-labelFile\">
                    <i class=\"icon fa fa-check\"></i>
                    <span class=\"js-fileName\">{$text_pick}</span>";
        $html .= self::help($item);
        $html .= "</label>";
        $html .= "</div>";
        return $html;
    }

    public static function required($item) {
        if (isset($item['options']['required'])) {
            return "required";
        } else {
            return '';
        }
    }

    public static function help($item) {
        if (isset($item['options']['help'])) {
            $html = "
                <div class='help'>
                    <i class=\"fa fa-question\" aria-hidden=\"true\"></i>
                    <div class='notice'>{$item['options']['help']}</div>
                </div>
            ";
            return $html;
        } else {
            return '';
        }
    }
}