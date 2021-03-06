<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->get('/tc', function (Request $request, Response $response) {
    echo $this->config->get('jwt_alg');
});

$app->get('/dummy', function (Request $request, Response $response) {
    $token = $request->getQueryParam('token');
    $data = JWT::decode($token, $this->conf->get('jwt_secret'), [$conf->get('jwt_alg')]);
    $response->getBody()->write("Token: " . print_r($data, true));
    return $response;
});

$app->get('/tmp1', function (Request $request, Response $response) {
    $template = $this->templateEngine->load('index.html');
    $meta = [
        [
            'id' => 'meta-xxx',
            'value' => 'asdf1234'
        ],
        [
            'id' => 'meta-yyy',
            'value' => 'zxcv9876'
        ]
    ];
    echo $template->render(['chiave' => 'valore', 'meta' => $meta]);
});

$app->post('/controller', function (Request $request, Response $response) {
    $template = $this->templateEngine->load('index.html');
    
    $toReturn = [
        'blocks' => [
            [
                'name' => 'messages',
                'content' => $template->renderBlock('messages', ['chiave1' =>'nuovoValore'])
            ]
        ],
        'actions' => [
            [
                'name' => 'consoleLog',
                'params' => [
                    'message' => "Body: " . print_r($request->getParsedBody(), true)
                ]
            ]
        ]
    ];
    
    return json_encode($toReturn);
});

$app->get('/sing1', function (Request $request, Response $response) {
    $this->client->clearMessages();
    $this->client->addMessage('m1');
    $this->client->addMessage('m2');
    echo print_r($this->client->getMessages(), true);
});