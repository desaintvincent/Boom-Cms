<?php


namespace Apps\Users\Model;


use Boom\Helper\Security;
use Boom\Model\Model;

class User extends  Model
{

    public function authentify()
    {
        $user = $this->find('first', [
            "where" => [
                "login" => $this->login
            ]
        ]);

        if ($user && $user->password === Security::crypt($this->password)) {
        	return $user;
        }

        return false;
    }

}