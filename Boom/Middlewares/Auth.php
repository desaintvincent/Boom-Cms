<?php


namespace Boom\Middlewares;


use Apps\Users\Model\User;
use Boom\Helper\Session;
use Cake\ORM\TableRegistry;
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
        if (!\Boom\Helper\Auth::connected()) {
            return $response = $response->withRedirect("/app/users/users/adminConnect");
        } else {
            // On check si ça correspon bien a un user

            $model = TableRegistry::get('Users', ['className' => 'Apps\Users\Model\UsersTable']);
            $user = $model->find('all', [
                "where" => [
                    "token" => Session::get("token")
                ]
            ])->first();
            
            if (empty($user)) {
                return $response = $response->withRedirect("/app/users/users/adminConnect");
            } else {
                return $next($request, $response);
            }
        }
    }
}