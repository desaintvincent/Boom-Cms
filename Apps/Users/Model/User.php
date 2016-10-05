<?php


namespace Apps\Users\Model;


use Apps\Users\Model\Entities\UserEntity;
use Boom\Helper\Session;
use Boom\Helper\Token;
use Cake\ORM\Table;

class User extends  Table
{
    public $prefix = "usr_";

    public function initialize(array $config)
    {
       $this->entityClass(UserEntity::class);
       /*$this->belongsTo('Categories');*/
    }

    /*public function buildRules(RulesChecker $rules){
        $rules->add($rules->isUnique(['slug']));
        return $rules;
    }*/

    public function authentify($user)
    {
        $db_user = $this->find()->where([
            "login" => $user->login
        ])->first();

        if ($db_user && $db_user->password === $user->password) {
            $token = Token::generate($user);
            Session::set("token", $token);
            $db_user->token = $token;
            $this->save($db_user);

            return true;
        }

        return false;
    }

}