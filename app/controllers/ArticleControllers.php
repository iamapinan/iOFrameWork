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



}