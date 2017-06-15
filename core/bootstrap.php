<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Noodlehaus\Config;

/*
 * Register Error Handler
 */
function initErrorHandler() {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    
    return $whoops;
}
$whoops = initErrorHandler();

/*
 * Load .env
 */
function loadDotEnv() {
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
    $dotenv->load();    
    
    return $dotenv;
}
$dotEnv = loadDotEnv();

/*
 * Load configurations
 */
function loadConfigurations() {
    $configFiles = [];
    
    // Common configuration files
    $commonConfigFiles = glob(__DIR__ . '/../app/config/*.php');
    foreach ($commonConfigFiles as $commonConfigFile) {
        $configFiles[] = $commonConfigFile;
    }
    
    // Modules configuration files
    $modulesConfigFiles = glob(__DIR__ . '/../app/modules/*/config/*.php');
    foreach ($modulesConfigFiles as $modulesConfigFile) {
        $configFiles[] = $modulesConfigFile;
    }
    
    // Load all configuration files
    $conf = new Config($configFiles);
    
    return $conf;
}
$conf = loadConfigurations();

/*
 * Logger
 */
function initLogger($conf) {
    $log = new Logger('name');
    $log->pushHandler(new StreamHandler($conf['loggerPath'],
            constant("Monolog\Logger::{$conf['loggerLevel']}")));
    
    return $log;
}
$log = initLogger($conf);

/*
 * Templates
 */
function initTemplateEngine() {
    //TODO: definire templates per i moduli
    $loader = new Twig_Loader_Filesystem(['../app/templates']);
    $twig = new Twig_Environment($loader, array(
        'cache' => '../app/templates_cache'
    ));
    return $twig;    
}
$twig = initTemplateEngine();

/*
 * Init Slim Application
 */
$app = new \Slim\App;

// Load common routes
$commonRoutes = glob(__DIR__ . '/../app/routes/*.php');
foreach ($commonRoutes as $route) {
    require_once $route;
}

// Load modules routes
$modulesRoutes = glob(__DIR__ . '/../app/modules/*/routes/*.php');
foreach ($modulesRoutes as $route) {
    require_once $route;
}

$app->run();
