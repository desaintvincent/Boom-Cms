<?php


namespace Boom\Middlewares;


use Apps\Users\Model\User;
use Boom\Helper\Session;

class Auth
{
    public function __invoke($request, $response, $next)
    {
        // On check la session s'il y a un token
        if (!Session::get("token")) {
        	error("You are not authorized to do this!");
            return $response->withStatus(404);
        } else {
            // On check si ça correspon bien a un user
            $model = new User();
            $user = $model->find('first', [
                "where" => [
                    "token" => Session::get("token")
                ]
            ]);

            if (empty($user)) {
                error("You are not authorized to do this!");
                return $response->withStatus(404);
            } else {
                return $next($request, $response);
            }
        }
    }
}