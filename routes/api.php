<?php
/**
 * API Route
 */

$route->group(getconst('api_prefix'), function() {
    $this->get('/test', function () {
        echo json(this());
    });

    $this->get('articles', function(){
        echo json_encode([
            [
                'id' => 1,
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'header' => 'Header1',
                'creator' => [
                    'name' => 'First Last'
                ],
                'date' => '20/05/2018 sss'
            ]
        ]);
    });
});