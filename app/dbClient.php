<?php
namespace App;
use Medoo\Medoo;

class dbClient {
    var $connect = '';
    function __construct() {
        $this->connect = new Medoo([
            'database_type' => getconst('default_database'),
            'database_name' => getenv('mysql_database_name'),
            'server' => getenv('mysql_host'),
            'username' => getenv('mysql_user'),
            'password' => getenv('mysql_password')
        ]);
    }

    function select($tb, $f = array(), $cond = array()) {
        return $this->connect->select($tb, $f, $cond);
    }

    function insert($tb, $data) {
        return $this->connect->insert($tb, $data);
    }

    function update($tb, $data, $cond = array()) {
        return $this->connect->update($tb, $data, $cond);
    }

    function delete($tb, $cond) {
        return $this->connect->delete($tb, $cond);
    }

    function exec() {
        return $this->connect;
    }
}
