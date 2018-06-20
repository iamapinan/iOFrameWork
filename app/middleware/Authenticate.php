<?php
namespace App\Middleware;

class Authenticate extends \App\dbClient {

    public function VerifyUser($User, $Pass) {
        $SelectUser = $this->select(
            "users", 
            ["username", "password", "email", "first_name", "last_name", "school_id", "role_id(role)"], 
            ["username" => $User]
        );

        if(isset($SelectUser[0]['password']) && password_verify($Pass, $SelectUser[0]['password'])) {
            unset($SelectUser[0]['password']);
            $result = [
                "status" => "success",
                "data" => $SelectUser[0]
            ];
            return $result;
        } else {
            return false;
        }
    }

}