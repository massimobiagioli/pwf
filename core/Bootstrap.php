<?php

require __DIR__ . '/../vendor/autoload.php';

// Register ErrorHandler
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Load .env
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$env = getenv('ENVIRONMENT');
echo "ENVIRONMENT: $env";
