<?php
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

define('BASE_URL', '/Boom-Cms/');
$config['db']['host']   = "localhost";
$config['db']['user']   = "user";
$config['db']['pass']   = "password";
$config['db']['dbname'] = "exampleapp";
define('DB_HOST', '0.0.0.0');
define('DB_USER', 'boom_cms');
define('DB_PASS', 'boom_cms');
define('DB_NAME', 'boom_cms');

return $config;