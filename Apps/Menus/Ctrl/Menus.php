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
        $model = TableRegistry::get($type);
        $result = $model->find()->where(['title LIKE' => '%' . $arg . '%'])->limit(10);
        return $this->response->write(json_encode($result->all()));
    }

    function action_view($params = null)
    {
        if (!isset ($params[0])) return;
        $type = $params[0];
        $drivers = require 'Apps/Menus/Drivers/Drivers.php';
        foreach ($drivers as $driver) {
            if ($driver['type'] == $type) {
                $tab = [
                    'edit' => isset($params[1]),
                    'driver' => $driver,
                    'data' => null,
                ];
                if (isset($params[2]) && !empty($params[2]) && is_int(intval($params[2]))) {
                    $id = intval($params[2]);
                    $model = TableRegistry::get($type);
                    $result = $model->find()->where(['id' => $id])->first();
                    if (!empty($result)) {
                        $tab['data'] = [
                            'id' => $result->$id,
                            'title' => $result->title
                        ];
                    }
                }
                return $this->view($driver['view'], $tab);
            }
        }
    }
}