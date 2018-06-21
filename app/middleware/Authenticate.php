<?php
namespace App\Middleware;

class Authenticate extends \App\dbClient {

    public function VerifyUser($User, $Pass) {
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