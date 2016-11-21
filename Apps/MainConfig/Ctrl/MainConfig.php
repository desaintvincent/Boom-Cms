<?php


namespace Apps\MainConfig\Ctrl;


use Boom\Ctrl\Controller;
use Boom\Helper\Security;
use Boom\Helper\Session;

class MainConfig extends Controller
{
    function __construct($appname, $request, $response, array $params, $name)
    {
        $this->hasModel = false;
        parent::__construct($appname, $request, $response, $params, $name);
    }

}