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

    public function getClass($school, $userid) {
        $class = $this->db->select("chat_room", ["id", "title","code"], ["school_id"=>$school, "user_id" => $userid]);
        echo json($class, 200);
    }
}