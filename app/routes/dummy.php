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

$app->get('/tmp1', function (Request $request, Response $response) use ($twig) {
    $template = $twig->load('index.html');
    echo $template->render(['chiave' => 'valore']);
});

$app->post('/controller', function (Request $request, Response $response) use ($twig) {
    $template = $twig->load('index.html');
    
    $toReturn = [
        'blocks' => [
            [
                'name' => 'messages',
                'content' => $template->renderBlock('messages', ['chiave1' =>'nuovoValore'])
            ]
        ]
    ];
    
    return json_encode($toReturn);
});
