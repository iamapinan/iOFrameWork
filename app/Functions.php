<?php
use Dwoo\Core;

function get_constant($n) {
    global $const;
    return $const[$n];
}

function page_render($view, $params = []) {
    $template = new Core();
    $template->setCompileDir(getconst('template_cache'));
    return $template->get(getconst('template_dir') . $view, $params);
}

function all_request($req) {
    if(app('request')->method == 'POST'){
        return app('request')->body[$req];
    } else {
        return app('request')->query[$req];
    }
}

function app_request() {
    return app('request');
}

function register_func_alias($target, $original) {
    eval("function $target() { \$args = func_get_args(); return call_user_func_array('$original', \$args); }");
}

function to_json_respose($data = []) {
    return json_encode($data);
} 