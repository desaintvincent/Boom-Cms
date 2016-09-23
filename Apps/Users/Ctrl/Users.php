<?php


namespace Apps\Users\Ctrl;


use Boom\Ctrl\Controller;
use Boom\Helper\Session;

class Users extends Controller
{

    public function action_connect()
    {
        $user = $this->User->forge();
        if ($this->request->isPost()) {
            $user = $this->User->forge($this->request->getParsedBody());
            if ($user->authentify()) {
                var_dump('CONNECTÉ');die();
            } else {
                var_dump("MOINS COOL");die();
            }
        }

        $this->view('Connect', compact('user'));
    }

    public function action_logout()
    {
        Session::delete('token');
    }

}