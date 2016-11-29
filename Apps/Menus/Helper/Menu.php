<?php
namespace Apps\Menus\Helper;


use Apps\Menus\Model\MenusTable;
use Cake\ORM\TableRegistry;

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

    static function display_main_menu($class = '') {
        $config = TableRegistry::get('MainConfig');
        $menu_id = $config->find()->first();
        $menu_id = $menu_id->menu;
        if (!empty($menu_id)) {
            $model = TableRegistry::get('MenuItems');
            $model_page = TableRegistry::get('Pages');

            $mitems = $model->find()->where(['menu_id' => $menu_id], ['parent_id' => null])->order(['display_order' => 'ASC']);
            if (isset($class) && !empty($class)) {
                $html = "<ul class='main_menu {$class}'>";
            } else {
                $html = "<ul class='main_menu'>";
            }
            foreach ($mitems as $mitem) {
                $href = '#';
                if ($mitem->type == 'pages' && !empty($mitem->arg)) {
                    $page = $model_page->get($mitem->arg);
                    if (!empty($page)) {
                        $href = $page->slug;
                    }
                }
                $html .= "<li><a href='{$href}'>{$mitem->title}</a></li>";
            }
            $html .= "</ul>";
            return $html;
        }
        return null;
    }
}
