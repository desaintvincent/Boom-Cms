<?php


namespace Apps\Users\Model;


use Boom\Helper\Security;
use Boom\Helper\Session;
use Boom\Helper\Token;
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
            $token = Token::generate($user);
            Session::set("token", $token);
            $user->token = $token;
        	$userConnected = $this->forge((array) $user);
            $userConnected->save();

            return true;
        }

        return false;
    }

}