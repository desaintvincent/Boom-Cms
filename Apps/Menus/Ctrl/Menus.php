<?php
namespace Apps\Menus\Ctrl;

use Boom\Ctrl\Controller;
use Cake\ORM\TableRegistry;

class Menus extends Controller
{

    function action_ajax($params = null)
    {
        if (!(isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['arg']) && !empty($_GET['arg']))) return;

        $type = $_GET['type'];
        $arg = $_GET['arg'];
        $modelPage = TableRegistry::get($type);
        $pages = $modelPage->find()->where(['title LIKE' => '%' . $arg . '%'])->limit(10);
        return $this->response->write(json_encode($pages->all()));
    }

    function action_view($params = null)
    {
        if (!isset ($params[0])) return;
        $type = $params[0];
        $drivers = require 'Apps/Menus/Drivers/Drivers.php';
        foreach ($drivers as $driver) {
            if ($driver['type'] == $type) {
                return $this->view($driver['view'], [
                    'edit' => isset($params[1]),
                    'driver' => $driver,
                ]);
            }
        }
    }
}