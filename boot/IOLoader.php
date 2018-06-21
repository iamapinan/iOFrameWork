<?php
/**
 * Define constants
 */
define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', str_replace('/boot', '', __DIR__) . DS, TRUE);

/**
 * iO Framework Loader
 * 
 */
require (BASE_PATH . 'vendor/autoload.php');

/**
 * Load environments.
 */
$dotenv = new Dotenv\Dotenv(BASE_PATH);
$dotenv->load();

if( getenv('environment') == 'development' ) {
    /**
     * Show errors
     */
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    /**
     * Error handle
     */
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();

} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
}

/**
 * System constant.
 */
require ('../app/Constants.php');

/**
 * Register function to alias.
 */
require ('../app/Functions.php');
foreach ($fnc as $fn => $fv) {
    register_func_alias($fn, $fv);
}

/**
 * Load all route.
 */
require ('RouteLoader.php');

