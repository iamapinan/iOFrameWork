<?php

/**
 * Route initial
 */
$app            = System\App::instance();
$app->request   = System\Request::instance();
$app->route     = System\Route::instance($app->request);
$route          = $app->route;

/**
 * Load route config.
 */
require (BASE_PATH . 'routes/api.php');
require (BASE_PATH . 'routes/web.php');

$route->end();