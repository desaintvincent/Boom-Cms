<?php


namespace Apps\Users\Ctrl;


use Boom\Ctrl\Controller;
use Boom\Helper\Security;
use Boom\Helper\Session;

class Users extends Controller
{

    private function _connect()
    {
        $user = $this->Users->newEntity();
        if ($this->request->isPost()) {
            $user = $this->Users->newEntity($this->request->getParsedBody());
            $user->password = Security::crypt($user->password);
            if ($this->Users->authentify($user)) {
                return true;
            } else {
                return false;
            }
        }

        $this->view('Connect', compact('user'));
    }

    public function action_adminConnect()
    {
        if ($this->_connect()) {
        	return $this->redirect("admin");
        }
    }

    public function action_userConnect()
    {
        if ($this->_connect()) {
            return $this->redirect('accueil');
        }
    }

    public function action_logout()
    {
        Session::delete('token');
        return $this->redirect('admin');
    }

}