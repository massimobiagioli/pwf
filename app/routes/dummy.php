<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->get('/dummy', function (Request $request, Response $response) use ($conf) {
    $token = $request->getQueryParam('token');
    $data = JWT::decode($token, $conf->get('jwt_secret'), [$conf->get('jwt_alg')]);
    $response->getBody()->write("Tonen: " . print_r($data, true));
    return $response;
});

