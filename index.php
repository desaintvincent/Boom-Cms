<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//require
require 'vendor/autoload.php';

//autoload
spl_autoload_register(function ($classname) {
    require ("./class/" . $classname . ".class.php");
});

//récupération de la config du site
$config = require_once ("config/site.config.php");


//creation de l'application SLIM
$app = new \Slim\App(["settings" => $config]);

//création du container
$container = $app->getContainer();


//définition des vues:
$container['view'] = new \Slim\Views\PhpRenderer("./views/");


//route exemple
$app->get('/hello/[{name}]', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/annonce[{/name}]', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $annonce = new Annonce();
    $item = $annonce->get($name);
    $response = $this->view->render($response, "pages/annonce.view.php", ['item' => $item]);

    return $response;
});


//route home
$app->get('/', function (Request $request, Response $response) {
    $response = $this->view->render($response, "content.view.php");
    return $response;
});





//affichage
require ("views/head.view.php");
$app->run();
require ("views/foot.view.php");









