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
        echo $this->Encode($password);
    }

    public function Encode($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function postIndex(){
        $Authen = new Authenticate;
       
        $res = $Authen->VerifyUser(req('username'), req('password'));
        if($res != false) {
            echo json($res, 200);
        } else {
            $res = [
                "status" => "error",
                "msg" => "บัญชีผู้หรือรหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบ"
            ];
            echo json($res, 401);
        }
    }
    /**
     * REST API Default
     */
    public function getIndex() {
        echo json(["code" => 404, "status" => 'API not found'], 404);
    }

    /**
     * Register
     */
    public function postRegister() {
        $req = this()->body;

        $data = [
            "username" => req('email'),
            "password" => $this->Encode(req('password')),
            "email" => req('email'),
            "first_name" => req('first_name'),
            "last_name" => req('last_name'),
            "school_id" => 0,
            "role_id" => 2
        ];
        // echo json($data);
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
    public function postReset() {
        /**
         * Validate email from request and send password reset link to user email.
         */

         $usr = $this->db->selectOne('users', ["email"], ["username" => req('email')]);
         if($usr['email'] != null) {
            // Send reset email.
            echo json($usr);
         }
    }

    public function keyVerfiy($key) {

    }


}
?>