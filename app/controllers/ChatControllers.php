<?php
namespace App\Controllers;

use \App\DbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;

class ChatControllers{
    private $obj = [];
    private $db;

    public function __construct() {
        $this->db = new DbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getGroup($type, $userid) {
        if($userid != '') {
            $list = $this->db->select("classrooms", "*", ["user_id" => $userid]); //get room info
            for($x=0;$x<count($list);$x++) {
                $chat = $this->db->exec()->select("chat_msg", 
                ["[>]users" => ["user_id" => "id"]],
                ["chat_msg.msg", "chat_msg.timestamp", "chat_msg.user_id", "users.first_name(user_name)"],
                ["chat_msg.target_id" => $list[$x]['id'], "chat_msg.type" => $type, "LIMIT" => 1, "ORDER" => ["timestamp" => "DESC"]]
                );
                // echo json($chat);
                if(count($chat) > 0) {
                    $list[$x]['chat_msg'] = $chat[0];
                    $list[$x]['chat_time'] = date('d/m/Y H:i', $chat[0]['timestamp']);
                }
                $chat = [];
            }
            if(count($list) > 0) {
                $res = [
                    "status" => "success",
                    "data" => $list
                ];
                echo json($res, 200);
            }
        }
    }

    public function getChatroom($roomid) {
        $chat = $this->db->exec()->select("classrooms", 
        [
        '[>]schools' => ["school_id" => "id"],
        '[>]educations' => ["grade" => "id"]
        ],
        [
            "schools.name(school_name)", "classrooms.id(chat_id)", "classrooms.title",
            "classrooms.user_id","classrooms.grade", "educations.name(grade_name)"
        ], // Fields
        ["classrooms.id" => $roomid]); // Where condition

        $member = $this->db->select("student_classrooms", 
        [ "[>]users" => ["user_id" => "id"], "[>]roles" => ["id" => "id"] ], 
        ["users.first_name", "users.last_name", "users.id", "users.photo", "roles.name(role_name)"],
        ["student_classrooms.classroom_id" => $roomid]);

        $msg = $this->db->PaginationMulti("chat_msg", 
            ["[>]users" => ["user_id" => "id"]],
            ["chat_msg.msg", "chat_msg.timestamp", "chat_msg.user_id", "users.first_name(user_name)", "users.photo(user_photo)"],
            ["chat_msg.target_id" => $roomid], 
            ["timestamp" => "DESC"],
            10
        );

        echo json(["info" => $chat, "member" => $member, "msg" => $msg]);
    }


}