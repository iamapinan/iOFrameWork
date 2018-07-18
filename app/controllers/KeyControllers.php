<?php
namespace App\Controllers;

use IOFramework\Database\MySQL;
use \App\MiddleWare\BasicAuthen;

class KeyControllers {
    public function __construct() {
        $this->db = new MySQL;
        $basic = new BasicAuthen;
        $basic->Check();
    }

    public function getIndex() {

    }
}