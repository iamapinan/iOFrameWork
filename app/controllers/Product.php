<?php
namespace controllers;

use app\dbClient;

class Product {
    var $connect = '';
    public function __construct() {
        $this->connect = new dbClient;
    }

    public function get_product() {
       return $this->connect->select('products',['name']);
    }

    public function index() {
        $data = $this->get_product();
        echo render('product.tpl', ["product" => $data]);
    }
}