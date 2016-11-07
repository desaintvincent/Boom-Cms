<?php


namespace Boom\Middlewares;


use Apps\Users\Model\User;
use Boom\Helper\Session;
use Cake\ORM\TableRegistry;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BeforeSave
{


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        if ($request->isPost()) {
            //dd($request->getParsedBody());
        }
        return $next($request, $response);
    }
}