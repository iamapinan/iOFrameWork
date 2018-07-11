<?php
namespace App\Controllers;

class Home {

    public function __construct() {
    }

    public function index() {
        echo render('home', ['page_title' => 'Welcome to I/O Framework']);
    }

    public function landing($id) {
        echo render('viewer', ['page_title' => 'Viewing: ' . $id]);
    }
}