<?php
namespace App\Controllers;

use \App\MiddleWare\BasicAuthen;
use \App\MiddleWare\UploadFile;

class UserController {
    private $db;

    public function __construct() {
        $this->db = new \App\DbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function userInfo($user_id) {

    }

    public function updateProfile() {
        
    }

    public function changePassword() {
    }
}