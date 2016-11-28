<?php


namespace Apps\Users\Ctrl;


use Boom\Ctrl\Controller;
use Boom\Helper\Security;
use Boom\Helper\Session;

class Users extends Controller
{

    public function action_adminConnect()
    {
        return $this->_connect('admin');
    }

    private function _connect($redirect = 'accueil')
    {
        $user = $this->Users->newEntity();
        if ($this->request->isPost()) {
            $user = $this->Users->newEntity($this->request->getParsedBody());
            $user->password = Security::crypt($user->password);
            if ($this->Users->authentify($user)) {
                return $this->redirect($redirect);
            } else {
                return $this->view('Connect', ['error' => __('Utilisateur ou mot de passe incorecte')]);
            }
        }

        return $this->view('Connect', compact('user'));
    }

    public function action_userConnect()
    {
        return $this->_connect('accueil');
    }

    public function action_logout()
    {
        Session::delete('token');
        return $this->redirect('admin');
    }

}