<?php
namespace Boom;

use Apps\Catalogue\Ctrl\Products;
use Boom\Helper\App;

class Bootstrap {
    private $request;
    private $response;

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    function dispatch($appname, $params = array()) {
        $appname = ucfirst($appname);
        if (App::exist($appname)) {
            $ctrl = App::getCtrlFromRoute($appname, $params);
            $action = App::getActionFromRoute($appname, $ctrl, $params);

            $appnamespace = '\Apps\\'.ucfirst($appname).'\Ctrl\\'.$ctrl;

            $app = new $appnamespace(ucfirst($appname), $this->request, $this->response, $params, $ctrl);
            $app->$action($params);
        } else {
            echo 'Error: Application ' .$appname . ' doesn\'t exist!';
        }
    }
}