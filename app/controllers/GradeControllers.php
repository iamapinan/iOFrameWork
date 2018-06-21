<?php
namespace App\Controllers;

use \App\dbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;

class GradeControllers{
    private $obj = [];
    private $db;

    public function __construct() {
        $this->db = new dbClient;
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

        if(!empty(req('grade')) && !empty(req('email')) && !empty(req('classNumber'))) {
            $user = $this->db->selectOne('users', ['id(user_id)', 'school_id', 'role_id'], ['username' => req('email')]);

            if($user['role_id'] == 1) {
                $grade = $this->db->selectone("educations", ["name"], ["id" => req('grade')]);
                $data = [
                    "title" => $grade["name"] .'/'. req('classNumber'),
                    "user_id" => $user['user_id'],
                    "grade" => req('grade'),
                    "class" => req('classNumber'),
                    "school_id" => $user['school_id']
                ];
    
                $this->db->insert('classrooms', $data);
            }

            if($user['role_id'] == 2) {
                $data = [
                    "user_id" => $user['user_id'],
                    "classroom_id" => req('classNumber')
                ];
    
                $this->db->insert('student_classrooms', $data);
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