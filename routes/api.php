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
    $this->controller('/grade', 'App\Controllers\GradeControllers');
    $this->controller('/chat', 'App\Controllers\ChatControllers');
    $this->controller('/article', 'App\Controllers\ArticleControllers');
});