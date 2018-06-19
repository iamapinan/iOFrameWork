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

/**
 * System constant.
 */
require ('../App/Constants.php');

/**
 * Register function to alias.
 */
require ('../App/Functions.php');
foreach ($fnc as $fn => $fv) {
    register_func_alias($fn, $fv);
}

/**
 * Load all route.
 */
require ('RouteLoader.php');

if( getenv('environment') == 'dev' ) {
    /**
     * Show errors
     */
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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