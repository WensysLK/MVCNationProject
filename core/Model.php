<?php
class Model {
    protected $db;

    public function __construct() {
        $config = require_once '../config/config.php';
//        var_dump(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//        die();
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }
}
