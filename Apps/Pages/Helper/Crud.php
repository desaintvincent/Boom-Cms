<?php


namespace Apps\Pages\Helper;


class Crud extends \Boom\Helper\Crud
{
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
}