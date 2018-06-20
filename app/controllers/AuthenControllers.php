<?php
namespace App\Controllers;

use \App\dbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;
class AuthenControllers{
    private $obj = [];

    public function __construct() {
        $this->db = new dbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getEncode($password) {
        echo password_hash($password, PASSWORD_BCRYPT);
    }

    public function postIndex(){
        $Authen = new Authenticate;
        $res = $Authen->VerifyUser(req('username'), base64_decode( req('password') ));
        echo json($res);
    }

    public function getIndex() {

    }

    /**
     * Register
     */
    public function postRegister() {
        $req = this()->body;

        $data = [
            "username" => req('email'),
            "password" => Authenticate::EncPassword(base64_decode(('password'))),
            "email" => req('email'),
            "first_name" => req('first_name'),
            "last_name" => req('last_name'),
            "school_id" => 0,
            "role_id" => 2
        ];

        $this->db->insert("users", $data);
        if($this->db->exec()->id() != 0) {
            unset($data['password']);
            $res = [
                "status" => "success",
                "data" => $data
            ];
            echo json($res, 200);
        } else {
            $res = [
                "status" => "error",
                "msg" => "ไม่สามารถสร้างบัญชีผู้ใช้ของคุณได้ กรุณาตรวจสอบ หรือติดต่อผู้ดูแล"
            ];
            echo json($res, 501);
        }
    }
    /**
     * Reset Password
     */



}
?>