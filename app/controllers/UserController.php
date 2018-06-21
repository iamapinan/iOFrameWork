<?php
namespace App\Controllers;


class UserController {

    public function __construct() {

    }

    public function getCoursebyUserId($user_id){
        $db = new \App\DbClient ;
        $result = $db->select("course_register", '*', [
            'user_id' => $user_id
        ]);
        $group_by = array_key_by($result, 'course_id');
        $data = [
            'all' => $result,
            'group_by_course_id' => $group_by, 
        ];
        echo json(encap_data($data));
    }
}