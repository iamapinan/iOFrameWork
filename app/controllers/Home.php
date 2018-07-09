<?php
namespace App\Controllers;

class Home {

    public function __construct() {
    }

    public function index() {
        echo render('home');
    }
}