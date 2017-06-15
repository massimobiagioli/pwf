<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/dummya', function (Request $request, Response $response) {
    $response->getBody()->write("Dummy App a");
    return $response;
});

$app->get('/tmp1a', function (Request $request, Response $response) use ($twig) {
    $template = $twig->load('a_index.html');
    echo $template->render(['chiave' => 'valore-mod-a']);
});