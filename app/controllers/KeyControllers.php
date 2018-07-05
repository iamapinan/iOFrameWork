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

    public function generate($count) {
        $endpoint = getconst('keygen') . "/generate?sw=".getenv('APP_NAME')."&client=".getenv('APP_NAME')."&count=$count&length=" . getconst('keySize');
        $response = file_get_contents($endpoint);
        return json_decode($response);
    }
}