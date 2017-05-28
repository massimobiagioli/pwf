<?php

require __DIR__ . '/../vendor/autoload.php';

// Load .env
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$env = getenv('ENVIRONMENT');
echo "ENVIRONMENT: $env";
