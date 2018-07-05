<?php
namespace App\Controllers;

use \App\DbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;

class AuthenControllers{
    private $obj = [];

    public function __construct() {
        $this->db = new DbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getEncode($password) {
        echo $this->Encode($password);
    }

    public function Encode($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * REST API Default
     */
    public function postIndex(){
    }

    public function getIndex() {
    }

    /**
     * Register
     */
    public function postRegister() {
    }

    /**
     * Reset Password
     */
    public function postReset() {
    }
}
?>