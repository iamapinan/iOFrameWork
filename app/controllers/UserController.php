<?php
namespace App\Controllers;

use IOFramework\Database\MySQL;
use \App\MiddleWare\BasicAuthen;
use \App\MiddleWare\UploadFile;

class UserController {
    private $db;

    public function __construct() {
        $this->db = new MySQL;
        // $basic = new BasicAuthen;
        // $basic->Check();
    }

    public function userInfo($user_id) {

    }

    public function updateProfile() {

    }

    public function changePassword() {
    }
}