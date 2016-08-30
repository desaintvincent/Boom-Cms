<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//require
require 'vendor/autoload.php';

//récupération de la config du site
$config_site = require_once ("site.config.php");


//creation de l'application SLIM
$app = new \Slim\App(["settings" => $config_site]);

//création du container
$container = $app->getContainer();


//définition des vues:
$container['view'] = new \Slim\Views\PhpRenderer("./views/");

//accueil
$app->get('/', function (Request $request, Response $response) use ($app) {
    $boom = new \Boom\Bootstrap($request, $response);
    $response = $boom->dispatch('pages', array('accueil'));
    return $response;
})->setName('home');


//application
$app->get('/{app}[/{params:.*}]', function (Request $request, Response $response) use ($app) {
    $application = $request->getAttribute('app');
    $params = $request->getAttribute('params');
    //$app->redirect('/'.$pages);

    if ($application == 'pages' && empty($params)) {
        $router = $this->router;
        return $response->withRedirect('/');
    }
    $boom = new \Boom\Bootstrap($request, $response);
    $response = $boom->dispatch($application, $params);
    return $response;
})->setName('app');






//affichage
$app->run();









