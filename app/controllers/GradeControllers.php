<?php
namespace App\Controllers;

use \App\dbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;

class GradeControllers{
    private $obj = [];

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

    public function postClassroom() {
        if(!empty(req('grade')) && !empty(req('email')) && !empty(req('classNumber'))) {
            $user = $this->db->selectOne('users', ['id(user_id)', 'school_id'], ['username' => req('email')]);

            $data = [
                "user_id" => $user['user_id'],
                "grade" => req('grade'),
                "class" => req('classNumber'),
                "school_id" => $user['school_id']
            ];

            $this->db->insert('classrooms', $data);

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