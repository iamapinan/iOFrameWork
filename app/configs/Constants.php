<?php
/**
 * General constant.
 */
$const = [
    'api_prefix' => '/api',
    'template_dir' => BASE_PATH . 'templates',
    'default_database' => 'mysql',
    'template_cache' => BASE_PATH . 'cache/view',
    'testCheck' => true
];

/**
 * Function alias
 */
$fnc = [
    "getconst" => "get_constant",
    "render" => "page_render",
    "req" => "all_request",
    "this" => "app_request",
    "json" => "to_json_respose",
    "unsetArray" => "array_unset_recursive",
    "redirect" => "redirect_me",
];

