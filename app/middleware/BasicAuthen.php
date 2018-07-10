<?php
namespace App\Middleware;

use IOFramework\Database\MySQL;

class BasicAuthen extends MySQL {

    public function CheckHeader($User, $Pass) {
        $res = $this->select('basic_auth_app', ['name', 'secret'], ['appid' => $User] );
        if(count($res) > 0 && $Pass == $res[0]['secret']) {
            return true;
        } else {
            return false;
        }
    }

    public function Check() {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $this->CheckHeader($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) == false){
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
    }
    
}