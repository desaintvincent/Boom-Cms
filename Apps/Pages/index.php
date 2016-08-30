<?php
$app->get('[{pagename}]', function (Request $request, Response $response) {
    $page = $request->getAttribute('pagename');
    if (empty($page)) {
        $page = 'accueil';
    }
    $response->getBody()->write("Hello, $page");
    return $response;
});