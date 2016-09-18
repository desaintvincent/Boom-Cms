<?php
namespace Apps\Admin\Ctrl;

use Boom\Ctrl\Controller;
use Boom\Helper\App;

class Admin extends Controller
{

    function get_apps() {

    }

    function action_main($params = null)
    {
        $this->view('admin', ['apps' => App::getApps()]);
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
            $this->view('admin', ['apps' => App::getApps(), 'crud' => $crud]);
        } else {
            echo 'Crud configuration not found';
        }
    }
}