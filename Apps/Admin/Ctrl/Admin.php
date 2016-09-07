<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;

class Admin extends Controller
{

    function action_main($params)
    {
        $app_list = App::getApps();
        $apps = [];
        foreach ($app_list as $i => $app) {
            $conf = App::getConfig($app);
            $apps[$i]['name'] = $app;
            if (isset($conf['default_crud'])) {
            	$apps[$i]['crud'] = $conf['default_crud'];
            } else {
                $apps[$i]['crud'] = $app;
            }
        }
        $this->view('admin', ['apps' => $apps]);
    }

    function action_crud($params)
    {
        $appname = 'Pages';
        $crudName = 'Page';
        if (!empty($params)) {
            $appname = $params[0];
            $crudName = $params[0];
            if (isset($params[1])) {
                $crudName = $params[1];
            }
        }

        $crudFile = 'Apps' . DS . ucfirst($appname) . DS . 'Cruds' . DS . ucfirst($crudName) . '.php';
        if (file_exists($crudFile)) {
        	$crud = require $crudFile;
            $this->view('crud', compact('crud'));
        } else {
            echo 'Crud configuration not found';
        }
    }
}