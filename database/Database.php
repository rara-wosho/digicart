<?php

    class Database{
        private $host;
        private $username;
        private $password;
        private $database;
        private $conn;

        public function __construct($host = "localhost", $username = "root", $password = "", $database = "digicart") {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;

            $this->connect();
        }

        private function connect() {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function getConnection() {
            return $this->conn;
        }

        public function closeConnection() {
            $this->conn->close();
        }

    }