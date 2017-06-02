<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/dummya', function (Request $request, Response $response) {
    $response->getBody()->write("Dummy App a");
    return $response;
});

