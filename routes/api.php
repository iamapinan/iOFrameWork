<?php
/**
 * API Route
 */
$route->group(getconst('api_prefix'), function() {
    // Do some thing.
    $this->get('test', 'App\Controllers\TestControllers@testdb');
});