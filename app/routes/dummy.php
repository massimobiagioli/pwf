<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/dummy', function (Request $request, Response $response) use ($conf) {
    $response->getBody()->write("Dummy App - Valore: " . $conf->get('mod_a'));
    return $response;
});

