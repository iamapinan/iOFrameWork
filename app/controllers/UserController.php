<?php
namespace App\Controllers;

use \App\MiddleWare\BasicAuthen;

class UserController {
    private $db;

    public function __construct() {
        $this->db = new \App\DbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getCoursebyUserId($user_id){
        $result = $this->db->select("course_register", '*', [
            'user_id' => $user_id
        ]);
        $group_by = [];
        // check has registered coruse
        foreach ( $result as $k => $arr) {
            $c_id = $arr['course_id'] ;
            if (  $new_arr[$c_id]  )  {
                if ( $arr['status'] == 1 && $new_arr[$c_id]['status']==2 ) {
                    $new_arr[$c_id] = $arr ;
                }
            } else {
                $new_arr[$c_id] = $arr ;
            }
        }
        $data = [
            // 'all' => $result,
            'group_by_course_id' => $new_arr, 
        ];
        echo json(encap_data($data));
    }

    public function addStudent() {
        $std = $this->db->select("users", ["school_id"], ["id" => req('student_id'), "role_id" => 2]);
        if(count($std) != 0) {
            $data = [
                "user_id" => req('user_id'),
                "student_id" => req('student_id'),
                "school_id" => $std[0]["school_id"]
            ];
            $this->db->insert('parent_data', $data);

            if($this->db->exec()->id() != 0) {
                $res = [
                    "status" => "success",
                    "data" => $data
                ];
                echo json($res, 200);
            } else {
                $res = [
                    "status" => "error",
                    "msg" => "บันทึกข้อมูลไม่ได้ในขณะนี้"
                ];
                echo json($res, 501);
            }
        } else {
            $res = [
                "status" => "error",
                "msg" => "ไม่พบนักเรียน รหัสอาจไม่ถูกต้อง"
            ];
            echo json($res, 501);
        }
    }

    public function userInfo($user_id) {
        $data = $this->db->select("users", 
            [
                "[>]schools" => ["school_id" => "id"],
                "[>]roles" => ["role_id" => "id"]
            ],
            [
                "users.school_id", "users.first_name", "users.last_name", "users.id(user_id)", 
                "users.email", "users.photo", "roles.id(role_id)", "schools.name(school)", "roles.name(role)"
            ], 
            ["id" => $user_id]
        );
        if(count($data) != 0) {
                $res = [
                    "status" => "success",
                    "data" => $data[0]
                ];
                echo json($res, 200);
        } else {
            $res = [
                "status" => "error",
                "msg" => "ไม่พบข้อมูล"
            ];
            echo json($res, 501);
        }
    }

    public function changePassword() {
        $ret = $this->db->update('users', ['password' => password_hash(req('password'), PASSWORD_BCRYPT)], ['id' => req('user_id')]);
        if($ret->rowCount() != 0) {
            $res = [
                "status" => "success"
            ];
            echo json($res, 200);
        } else {
            $res = [
                "status" => "error",
                "msg" => "อัพเดทไม่สำเร็จ"
            ];
            echo json($res, 501);
        }
    }

    public function myStudent($user_id) {
        $ret = $this->db->select('parent_data', ["[>]users" => ["student_id" => "id"]], ["users.id(student_id)", "users.first_name", "users.last_name"], ['user_id' => $user_id]);
        if(count($ret) != 0) {
            $res = [
                "status" => "success",
                "data" => $ret[0]
            ];
            echo json($res, 200);
        } else {
            $res = [
                "status" => "error",
                "msg" => "ไม่พบข้อมูล"
            ];
            echo json($res, 501);
        }
    }
}