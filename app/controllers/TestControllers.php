<?php
namespace App\Controllers;

use IOFramework\Database\MySQL;

class TestControllers {
    protected $db;
    function __construct() {
        $this->db = new MySQL;
    }

    public function testdb() {
        $res = $this->db->select('test', "*");
        echo json($res);
    }
}