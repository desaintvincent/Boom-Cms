<?php
namespace Boom\Ctrl;

class Controller {
    protected $request;
    protected $response;
    protected $params;
    protected $action;

    public function __construct($request, $response, $params = array())
    {

        $this->request = $request;
        $this->response = $response;
        $this->params = $params;
        if (!empty($params[0])) {
            $this->action = 'main';
        }
    }

    public function run() {

    }

    public function action_main() {

    }
}