<?php
namespace App\Controllers;

use \App\dbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;

class ArticleControllers{
    private $obj = [];
    private $db;

    public function __construct() {
        $this->db = new dbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getList($schoolid) {
        $res = $this->db->pagination("article_data", ['id', 'title', 'uid', 'school_id', 'image', 'timestamp'], ["school_id" => $schoolid], ["id" => "DESC"], 10);

        echo json($res);
    }
}