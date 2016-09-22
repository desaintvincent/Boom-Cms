<?php


namespace Apps\Users\Ctrl;


use Boom\Ctrl\Controller;
use Boom\Helper\Session;
use Boom\Helper\Token;

class Users extends Controller
{

    public function action_connect($params = null)
    {
        $user = $this->User->forge();
        if ($this->request->isPost()) {
            $user = $this->User->forge($this->request->getParsedBody());
            if ($user = $user->authentify()) {
                $token = Token::generate($user);
            	Session::set("token", $token);
                $user->token = $token;
                $user->save();
            } else {
                var_dump("MOINS COOL");die();
            }
        }

        $this->view('Connect', compact('user'));
    }

    public function action_logout($params = null)
    {

    }

}