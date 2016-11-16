<?php
namespace Apps\Menus\Helper;


class Menu {

    static function make_admin_menu($mitems = null) {
        if (isset($mitems)) {
            echo '<ol class="dd-list">';
            foreach ($mitems as $mitem) {
                $html = '<li class="dd-item" data-id="'.$mitem->id.'" data-title="'.$mitem->title.'" data-type="'.$mitem->type.'" data-arg="'.$mitem->arg.'" data-new="0" data-deleted="0">';
                $html .= '<div class="dd-handle">'.$mitem->title.'</div>';
                $html .= '<span class="button-delete btn btn-default btn-xs pull-right" data-owner-id="'.$mitem->id.'">';
                $html .= '<i class="fa fa-times-circle-o" aria-hidden="true"></i>';
                $html .= '</span>';
                $html .= '<span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="'.$mitem->id.'">';
                $html .= '<i class="fa fa-pencil" aria-hidden="true"></i>';
                $html .= '</span>';
                echo $html;
                if (isset($mitem->children)) {
                    self::make_admin_menu($mitem->children);
                }
                echo '</li>';
            }
            echo '</ol>';
        }
    }

    static function make_select_drivers() {
        $drivers = require 'Apps/Menus/Drivers/Drivers.php';
        $html = "<select class='form-control select-type-mitem select-inline required' id='addInputType'>";
        $html .= "<option></option>";
        foreach ($drivers as $driver) {
            $html .= "<option value='" . $driver['type']. "'>" . $driver['title']. "</option>";
        }
        $html .= "</select>";
        return $html;
    }
}
