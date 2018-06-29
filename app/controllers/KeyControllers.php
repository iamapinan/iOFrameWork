<?php
namespace App\Controllers;

use \App\DbClient;
use \App\MiddleWare\BasicAuthen;

class KeyControllers {
    public function __construct() {
        $this->db = new DbClient;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getIndex() {

    }

    public function postKeygen() {
        if(!empty(req('role')) && !empty(req('org')) && !empty(req('count'))) {

            $generate = $this->generate(req('count'));
            foreach($generate as $key) {
                $data[] = [
                    "key" => $key,
                    "role_id" => (int)req('role'),
                    "org_id" => (int)req('org'),
                    "status" => 0
                ];
            }

            $insert = $this->db->insert('license_key', $data);
       
            if($this->db->exec()->id() != 0) {
                $res = [
                    "status" => "success",
                    "keys" => $data
                ];
                echo json($res, 200);
            } else {
                $res = [
                    "status" => "error",
                    "code" => 400
                ];
                echo json($res, 400);
            }

        } else {
                $res = [
                    "status" => "error",
                    "code" => 400
                ];
                echo json($res, 400);
        }
    }

    public function generate($count) {
        $endpoint = getconst('keygen') . "/generate?sw=".getenv('APP_NAME')."&client=".getenv('APP_NAME')."&count=$count&length=" . getconst('keySize');
        $response = file_get_contents($endpoint);
        return json_decode($response);
    }
}