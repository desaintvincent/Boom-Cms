<?php
namespace Apps\Menu\Ctrl;

use Apps\Pages\Model\Page;
use Boom\Ctrl\Controller;
use Cake\ORM\TableRegistry;

class Menus extends Controller
{
    function action_ajax($params = null)
    {
        if (!isset ($params[0]) || empty($params[0])) return;
       
        $modelPage =TableRegistry::get('Pages');
        $pages = $modelPage->find('all', [
            'where' => [
                'title' => ['like', '%' . $params[0] . '%']
            ],
            'limit' => 10,
        ]);
        echo json_encode($pages->all());
    }

    function action_view($params = null)
    {
        if (!isset ($params[0])) return;
        $type = $params[0];
        $drivers = require 'Apps/Menu/Drivers/Drivers.php';
        foreach ($drivers as $driver) {
            if ($driver['type'] == $type) {
                return $this->view($driver['view']);
            }
        }
    }
}