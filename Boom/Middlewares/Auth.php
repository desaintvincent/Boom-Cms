<?php


namespace Boom\Middlewares;


use Apps\Users\Model\User;
use Boom\Helper\Session;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Auth
{
    public function __construct(ContainerInterface $ci) {
        $this->ci = $ci;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        // On check la session s'il y a un token
        if (!Session::get("token")) {
        	//error("You are not authorized to do this!");
            return $response->withRedirect("/app/users/users/connect");
        } else {
            // On check si ça correspon bien a un user
            $model = new User();
            $user = $model->find('first', [
                "where" => [
                    "token" => Session::get("token")
                ]
            ]);

            if (empty($user)) {
                //error("You are not authorized to do this!");
                return $response->withRedirect("/app/users/users/connect");
            } else {
                return $next($request, $response);
            }
        }
    }
}