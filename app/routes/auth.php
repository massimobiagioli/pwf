<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;
use \Ramsey\Uuid\Uuid;

$app->group('/auth', function () use ($app, $conf) {

    $app->get('/login', function (Request $request, Response $response) use ($app, $conf) {
        $now = new DateTime();
        $future = new DateTime("now +2 hours");
        $jti = Uuid::uuid4();
        
        $scopes = [
            'moduleA',
            'moduleB'
        ];
        
        $payload = [
            'iat' => $now->getTimeStamp(),
            'exp' => $future->getTimeStamp(),
            'jti' => $jti,
            'iss' => 'backend',
            'sub' => "frontend",
            'scopes' => $scopes
        ];
        
        $secret = $conf->get('jwt_secret');
        $alg = $conf->get('jwt_alg');
        
        $data = [
            'token' => JWT::encode($payload, $secret, $alg)
        ];

        return $response->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    });
    
});
