<?php


namespace Boom\Middlewares;


class Auth
{
    public function __invoke($request, $response, $next)
    {
        // On check la session s'il y a un token
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
        	error("You are not authorized to do this!");
        } else {
            // On check si ça correspon bien a un user
            /*$model = new User();
            $user = $model->find('first', [
                "where" => [
                    "token" => $_SESSION['token']
                ]
            ]);

            if (empty($user)) {
                error("You are not authorized to do this!");
            } else {
                return $next($request, $response);
            }*/
        }
    }
}