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

    public function getGroup($userid) {
        if($userid != '') {
            $list = $this->db->select("classrooms", "*", ["user_id" => $userid]);
            if(count($list) > 0) {
                $res = [
                    "status" => "success",
                    "data" => $list
                ];
                echo json($res, 200);
            }
        }
    }


}