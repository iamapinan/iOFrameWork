<?php
/**
 * API Route
 */

$route->group(getconst('api_prefix'), function() {
    $this->get('/test', function () {
        echo json(this());
    });

    $this->controller('/authen', 'App\Controllers\AuthenControllers');
    $this->controller('/license', 'App\Controllers\KeyControllers');
});