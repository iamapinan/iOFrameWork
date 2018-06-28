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

    public function postChatroom() {

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
            } elseif(!empty(this()->body['code'])) {
                // require chatroom code
                $chatroom = $this->db->select('chat_room', ['id'], ['code' => req('code')]);

                if(count($chatroom)!=0) {
                    $data = [
                        "user_id" => req('user_id'),
                        "chat_room_id" => $chatroom[0]['id']
                    ];
                    $this->db->insert('chat_room_member', $data);
                }
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

    public function getGroup($userid) {
        if($userid != '') {
            $list = $this->db->select("chat_room", "*", ["user_id" => $userid]); //get room info
            for($x=0;$x<count($list);$x++) {
                $chat = $this->db->exec()->select("chat_msg", 
                ["[>]users" => ["user_id" => "id"]],
                ["chat_msg.msg", "chat_msg.timestamp", "chat_msg.user_id", "users.first_name(user_name)"],
                ["chat_msg.target_id" => $list[$x]['id'], "LIMIT" => 1, "ORDER" => ["timestamp" => "DESC"]]
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

    public function postMsg() {
        if(!empty(this()->body['msg']) && !empty(this()->body['user_id']) && !empty(this()->body['chat_room_id'])) {
            $data = ['user_id' => req('user_id'), 'msg' => req('msg'), 'target_id' => req('chat_room_id'), 'timestamp' => time()];
            $this->db->insert('chat_msg', $data);
            $data['timestamp'] = date('d/m/Y H:i', $data['timestamp']);
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
                "msg" => "ข้อมูลไม่ถูกต้อง"
            ];
            echo json($res, 501);
        }
    }

    public function getChatroom($roomid) {
        $chat = $this->db->exec()->select("chat_room", 
        [
        '[>]schools' => ["school_id" => "id"]
        ],
        [
            "schools.name(school_name)", "chat_room.id(chat_id)", "chat_room.title","chat_room.user_id"
        ], // Fields
        ["chat_room.id" => $roomid]); // Where condition

        $member = $this->db->select("chat_room_member", 
        [ "[>]users" => ["user_id" => "id"], "[>]roles" => ["id" => "id"] ], 
        ["users.first_name", "users.last_name", "users.id", "users.photo", "roles.name(role_name)"],
        ["chat_room.id" => $roomid]);

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