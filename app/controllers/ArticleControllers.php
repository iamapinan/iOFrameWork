<?php
namespace App\Controllers;

use \App\DbClient;
use \App\MiddleWare\Authenticate;
use \App\MiddleWare\BasicAuthen;

class ArticleControllers{
    private $obj = [];
    private $db;

    public function __construct() {
        $this->db = new DbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getList($schoolid) {
        // $res = $this->db->pagination("article_data", ['id', 'title', 'uid', 'school_id', 'image', 'timestamp'], ["school_id" => $schoolid], ["id" => "DESC"], 10);
        $res = $this->db->PaginationMulti("article_data", [
            "[>]users" => ["uid" => "id"]], 
            ['article_data.id', 'article_data.title', 'article_data.description'
            , 'article_data.uid', 'article_data.school_id', 'article_data.image'
            , 'article_data.timestamp', 'users.first_name', 'users.last_name'
            , 'users.last_name'], 
            ["article_data.school_id" => $schoolid], ["article_data.id" => "DESC"], 30);
        echo json($res);
    }

    public function getData($id) {
        $res = $this->db->selectOne("article_data", ['id', 'title', 'description', 'uid', 'school_id', 'image', 'timestamp'], ["id" => $id]);
        $res['timestamp'] = ($res['timestamp'] != null) ? date('d/m/Y H:i', $res['timestamp']) : time();
        echo json($res);
    }

    public function postAdd() {
        $school = $this->db->selectOne("users", ['school_id'], ["id" => req('userid')]);
        $data = [
            "title" => req('title'),
            "description" => req("description"),
            "uid" => req('userid'),
            "school_id" => $school['school_id'],
            "image" => "https://picsum.photos/200/300",
            "timestamp" => time()
        ];
        $this->db->insert("article_data", $data);

        if($this->db->exec()->id() != 0) {
            $res = [
                "status" => "success",
                "data" => $data
            ];
            echo json($res);
        }
    }
}