<?php

namespace App\Models;

class Database {
    protected $db;

    public function __construct()
    {
        $this->db = new \mysqli('localhost', 'root', '', 'doblefactor');
    }

    public function __destruct()
    {
        $this->db->close();
    }
}