<?php


namespace Apps\Users\Model;


use Apps\Users\Model\Entities\UserEntity;
use Boom\Helper\Session;
use Boom\Helper\Token;
use Boom\Model\Model;

class UsersTable extends Model
{
    public function initialize(array $config)
    {
        $this->entityClass(UserEntity::class);
    }

    public function authentify($user)
    {
        $db_user = $this->find()->where([
            "login" => $user->login
        ])->first();

        if ($db_user && $db_user->password === $user->password) {
            $token = Token::generate($user);
            Session::set("token", $token);
            Session::set("right", $db_user->right);
            $db_user->token = $token;
            $db_user->isConnecting = true;
            $this->save($db_user);
            return true;
        }

        return false;
    }

}