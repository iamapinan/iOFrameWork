<?php
/**
 * iOFramework by iOTech Enterprise Co.,Ltd.
 * A light weight PHP framework design for fast to setup and simple to create a new webapp.
 * 
 * @package ioframework
 * @author iOTech
 * @license MIT
 * 
 * Index file do not edit this file.
 */

define('SYSTEM_START', microtime(true));
define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', str_replace( '/public', '', __DIR__ ) . DS, TRUE);

/**
 * Load composer autoload
 */
require_once (BASE_PATH . 'vendor/autoload.php');

/**
 * System load
 */
$load = new IOFramework\Loader;
$load->registerFunction();
$load->Route();