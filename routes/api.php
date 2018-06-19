<?php
/**
 * API Route
 */

$route->group(getconst('api_prefix'), function() {
    $this->get('/test', function () {
        echo json(this());
    });

    $this->get_post('/login', 'App\Controllers\LoginControllers@login');

});