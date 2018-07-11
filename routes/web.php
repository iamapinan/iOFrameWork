<?php
/**
 * Web route.
 */

$route->any('/', 'App\Controllers\Home@index');
$route->any('/view/{id}', 'App\Controllers\Home@landing');
?>