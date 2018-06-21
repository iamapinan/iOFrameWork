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
}