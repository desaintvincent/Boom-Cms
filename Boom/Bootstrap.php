<?php
namespace Boom;

class Bootstrap {
    private $request;
    private $response;

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    function dispatch($app, $params = array()) {
        $appname = '\Apps\\'.ucfirst($app).'\Ctrl\\'.ucfirst($app);
        if (class_exists($appname)) {
            $myapp = new $appname($this->request, $this->response, $params);
        } else {
            echo 'Error: classe ' .$appname . ' doesn\'t exist!';
        }

    }
}