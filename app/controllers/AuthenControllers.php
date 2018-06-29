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

    public function postIndex(){
        $Authen = new Authenticate;
       
        $ret = $Authen->VerifyUser(req('username'), req('password'));
        if($ret == true) {
            // $user_data = $this->db->exec()->debug()->select(
            //     "users",["[>]schools" => ["school_id" => "id"]], 
            //     ["users.id", "users.username", "users.email", "users.first_name", "users.last_name", "users.school_id", "users.role_id(role)","schools.name(school_name)"], 
            //     ["users.username" => req('username'),"LIMIT" => 1]
            // );

            $user_data = $this->db->exec()->select(
                "users",["[>]schools" => ["school_id" => "id"]], 
                ["users.id", "users.username", "users.email", "users.first_name", "users.last_name", "users.school_id", "users.role_id(role)", "users.photo(photo)","schools.name(school_name)"], 
                ["users.username" => req('username'),"LIMIT" => 1]
            );

            $res = [
                "status" => "success",
                "data" => $user_data[0]
            ];

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

        $user_data = $this->db->exec()->select(
        "users", 
        ["users.id"], 
        ["users.email" => req('email'),"LIMIT" => 1]);

        if(count($user_data) != 0) {
            $res = [
                "status" => "error",
                "msg" => "ไม่สามารถสร้างบัญชีผู้ใช้ของคุณได้ กรุณาตรวจสอบ หรือติดต่อผู้ดูแล"
            ];
            echo json($res, 501);
            exit;
        }

        // $req = this()->body;

        $get_key = $this->db->select('license_key', ['role_id', 'key', 'org_id', 'id'], ['key' => req('key'), 'status' => 0]);

        if(isset($get_key[0]['id'])) {
            $data = [
                "username" => req('email'),
                "password" => $this->Encode(req('password')),
                "email" => req('email'),
                "first_name" => req('first_name'),
                "last_name" => req('last_name'),
                "school_id" => $get_key[0]['org_id'],
                "role_id" => $get_key[0]['role_id'],
                "photo" => 'https://picsum.photos/200/300'
            ];
            
            $this->db->update('license_key', ['status' => 1], ['id' => $get_key[0]['id']]);
            $this->db->insert("users", $data);
        } else {
            $res = [
                "status" => "error",
                "msg" => "รหัสลงทะเบียนไม่ถูกต้อง กรุณาลองใหม่"
            ];
            echo json($res, 501);
            exit;
        }
        
        if($this->db->exec()->id() != 0) {
            $user_data = $this->db->exec()->select(
                "users",["[>]schools" => ["school_id" => "id"]], 
                ["users.id", "users.username", "users.email", "users.first_name", "users.last_name", "users.school_id", "users.role_id(role)", "users.photo(photo)","schools.name(school_name)"], 
                ["users.email" => req('email'),"LIMIT" => 1]
            );
            $res = [
                "status" => "success",
                "data" => $user_data
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