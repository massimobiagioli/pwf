<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/pilot', function () use ($app) {

    $app->get('/', function (Request $request, Response $response) {
        $template = $this->templateEngine->load('index.html');
        echo $template->render();
    });
    
});
