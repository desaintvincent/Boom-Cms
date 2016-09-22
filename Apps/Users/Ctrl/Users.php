<?php


namespace Apps\Users\Ctrl;


use Boom\Ctrl\Controller;

class Users extends Controller
{

    public function action_connect($params = null)
    {
        $this->view('Connect');
    }

    public function action_logout($params = null)
    {

    }

}