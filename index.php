<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define('DS', DIRECTORY_SEPARATOR);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
error_reporting(E_ALL);

//require
require 'vendor/autoload.php';

//récupération de la config du site
$config_site = require_once ("site.config.php");

//creation de l'application SLIM
$slim = new \Slim\App(["settings" => $config_site]);

//création du container
$container = $slim->getContainer();

//définition des vues:
//$container['view'] = new \Slim\Views\PhpRenderer("./views/");

//applications
$slim->any('/app/{appname}[/{params:.*}]', function (Request $request, Response $response) use ($slim) {
    $appname = $request->getAttribute('appname');
    $params = $request->getAttribute('params');
    $boom = new \Boom\Bootstrap($request, $response);
    $boom->dispatch($appname, explode('/', $params));
    return $response;
})->setName('app');

//admin
$slim->any('/admin[/{params:.*}]', function (Request $request, Response $response) use ($slim) {
    $params = $request->getAttribute('params');
    if (empty($params)) {
        $params  = 'accueil';
    }
    $boom = new \Boom\Bootstrap($request, $response);
    $boom->dispatch('admin', explode('/', $params));
    return $response;
})->setName('admin');

//pages
$slim->any('[/{params:.*}]', function (Request $request, Response $response) use ($slim) {
    $params = $request->getAttribute('params');
    if (empty($params)) {
        $params  = 'accueil';
    }
    $boom = new \Boom\Bootstrap($request, $response);
    $boom->dispatch('pages', explode('/', $params));
    return $response;
})->setName('pages');

//affichage
$slim->run();