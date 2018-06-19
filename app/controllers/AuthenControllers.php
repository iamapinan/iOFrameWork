<?php
namespace App\Controllers;

use \App\dbClient;
use \App\MiddleWare\Authenticate;

class AuthenControllers{
    private $obj = [];

    public function __construct() {
        $this->db = new dbClient;
    }

    public function getEncode($password) {
        echo password_hash($password, PASSWORD_BCRYPT, ["salt" => getenv('TokenSecret')]);
    }

    public function postIndex(){
        $Authen = new Authenticate;
        $res = $Authen->VerifyUser(req('username'), base64_decode( req('password') ));
        echo json($res);
    }

    /**
     * Register
     */

    /**
     * Reset Password
     */



}
?>