<?php
namespace App\Middleware;

class BasicAuthen extends \App\dbClient {

    public function CheckHeader($User, $Pass) {
        $res = $this->select('basic_auth_app', ['name', 'secret'], ['appid' => $User] );
        if($this->AuthVerify($Pass, $res[0]['secret'])) {
            return true;
        } else {
            return false;
        }
    }

    public function Basic() {
        if($this->CheckHeader($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
            header('Cache-Control: no-cache, must-revalidate, max-age=0');
        } else {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
    }

    public function AuthVerify($Pass, $Secret) {
        if(base64_decode($Pass) == $Secret) {
            return true;
        } else {
            return false;
        }
    }
    
}