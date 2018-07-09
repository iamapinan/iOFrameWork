<?php
namespace App\Middleware;

use IO\Framework\Database\MySQL;

class Authenticate extends MySQL {

    public function Authen($User, $Pass) {
        $SelectUser = $this->select(
            "users", 
            ["password"], 
            ["username" => $User]
        );

        if(isset($SelectUser[0]['password']) && password_verify($Pass, $SelectUser[0]['password'])) {
            return true;
        } else {
            return false;
        }
    }

}