<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Noodlehaus\Config;

/*
 * Load .env
 */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../..');
$dotenv->load(); 

/*
 * Register Error Handler
 */
function initErrorHandler() {
    $whoops = new \Whoops\Run;
    if (strtolower(getenv('ENVIRONMENT')) === 'production') {
        // TODO: define error handler for production environment
    } else {
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    }
    $whoops->register();
    
    return $whoops;
}
$whoops = initErrorHandler();

/*
 * Load configurations
 */
function loadConfigurations() {
    $configFiles = [];
    
    // Common configuration files
    $commonConfigFiles = glob(__DIR__ . '/../../app/config/*.php');
    foreach ($commonConfigFiles as $commonConfigFile) {
        $configFiles[] = $commonConfigFile;
    }
    
    // Modules configuration files
    $modulesConfigFiles = glob(__DIR__ . '/../../app/modules/*/config/*.php');
    foreach ($modulesConfigFiles as $modulesConfigFile) {
        $configFiles[] = $modulesConfigFile;
    }
    
    // Load all configuration files
    $conf = new Config($configFiles);
    
    return $conf;
}

/*
 * Logger
 */
function initLogger($conf) {
    $log = new Logger('name');
    $log->pushHandler(new StreamHandler($conf['loggerPath'],
            constant("Monolog\Logger::{$conf['loggerLevel']}")));
    
    return $log;
}

/*
 * Templates
 */
function initTemplateEngine() {
    $templates = ['../app/templates'];
    
    // Modules templates
    $modulesTemplates = glob(__DIR__ . '/../app/modules/*/templates/');
    foreach ($modulesTemplates as $moduleTemplate) {
        $templates[] = $moduleTemplate;
    }

    // Init loader
    $loader = new Twig_Loader_Filesystem($templates);
    $twig = new Twig_Environment($loader, array(
        'cache' => '../app/templates_cache'
    ));
    return $twig;    
}

// Init App container
$container = new \Slim\Container();

// Disable Slim error handler
unset($container['errorHandler']);
unset($container['phpErrorHandler']);

// Register services
$container['client'] = function ($container) {
    return new \Core\Client\Client();
};
$container['config'] = function ($container) {
    return loadConfigurations();
};
$container['log'] = function($container) {
    return initLogger($container['config']);
};
$container['templateEngine'] = function($container) {
    return initTemplateEngine();
};

/*
 * Init Slim Application
 */
$app = new \Slim\App($container);

// Load common routes
$commonRoutes = glob(__DIR__ . '/../../app/routes/*.php');
foreach ($commonRoutes as $route) {
    require_once $route;
}

// Load modules routes
$modulesRoutes = glob(__DIR__ . '/../../app/modules/*/routes/*.php');
foreach ($modulesRoutes as $route) {
    require_once $route;
}

$app->run();
