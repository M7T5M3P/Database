<?php

namespace Classes;

use mysqli;

class Connection {
    private $conn = null;

    function get_connection() {
        if ($this->conn === null) {
            $path = parse_ini_file('./login.ini');
            $servername = $path['servername'];
            $username = $path['username'];
            $password = $path['password'];
            $dbname = $path['dbname'];
            $this->conn = new mysqli($servername, $username, $password, $dbname);

            if ($this->conn->connect_error) {
                throw new \mysqli_sql_exception('Connection failed: ' . $this->conn->connect_error);
            }

            if (!$this->conn->set_charset("utf8mb4")) {
                throw new \mysqli_sql_exception('Error loading character set utf8mb4: ' . $this->conn->error);
            }
        }
        return $this->conn;
    }
}
