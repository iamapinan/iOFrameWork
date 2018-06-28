<?php
namespace App\Controllers;

use app\DbClient;

class Product {
    var $connect = '';
    public function __construct() {
        $this->connect = new DbClient;
    }

    public function get_product() {
       return $this->connect->select('products',['name']);
    }

    public function index() {
        $data = $this->get_product();
        echo render('product.tpl', ["product" => $data]);
    }
}