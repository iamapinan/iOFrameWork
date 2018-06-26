<?php
namespace App\Controllers;

use \App\DbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;

class GradeControllers{
    private $obj = [];
    private $db;

    public function __construct() {
        $this->db = new DbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getList() {
        $data = $this->db->select('educations', '*');
        $res = [
            "status" => "success",
            "data" => $data
        ];
        echo json($res);
    }

    public function getClass($school, $grade) {
        $class = $this->db->select("classrooms", ["id", "title"], ["school_id"=>$school, "grade" => $grade]);
        echo json($class, 200);
    }

    public function postClassroom() {

        if(!empty(req('user_id'))) {
            $user = $this->db->selectOne('users', ['id', 'school_id', 'role_id'], ['id' => req('user_id')]);
        
            if($user['role_id'] == 1) {

                $data = [
                    "title" => req('name'),
                    "user_id" => $user['id'],
                    "code" => strtoupper(rand(1, 9) . substr(uniqid(), 0, 4) . chr(rand(ord('a'), ord('z')))),
                    "school_id" => $user['school_id']
                ];
    
                $this->db->insert('chat_room', $data);
            } else {
                $chatroom = $this->db->select('chat_room', ['id'], ['code' => req('code')]);
                // require chatroom code
                $data = [
                    "user_id" => req('user_id'),
                    "chat_room_id" => $chatroom[0]['id']
                ];
    
                $this->db->insert('chat_room_member', $data);
            }

            if($this->db->exec()->id() != 0) {
                $res = [
                    "status" => "success",
                    "data" => $data
                ];
                echo json($res, 200);
            } else {
                $res = [
                    "status" => "error",
                    "msg" => "ข้อมูลบางอย่างไม่ถูกต้อง"
                ];
                echo json($res, 501);
            }

        } 
    }
}