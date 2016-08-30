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

//pages
$app->get('/{app}[/{pagename}]', function (Request $request, Response $response) use ($app) {
    echo('pages');
    //if applicationname == $application => go to app
    //else if page.find($pagename) => go to page $pagename
    $pagename = $request->getAttribute('pagename');
    $application = $request->getAttribute('app');
    echo($pagename);
    echo($application);
    //$app->redirect('/'.$pages);

    return $response;
});




//affichage
$app->run();









