<?php

    class Database {
        private $servername = "database"; //docker sees database as the correct local url
        private $database = "webshop";
        private $username = "Webuser";
        private $password = "Lab2021";
        private mysqli $db;
        private mysqli_stmt $stmt;
    

        function connect(){
            try {
                $this->db = mysqli_connect($this->servername,$this->username,$this->password, $this->database);
            }
            catch(Exception $e){
                echo($e);
            }
        }
        function prepare($query){
            $this->stmt = mysqli_prepare($this->db , $query);
        }
        function bind_param($format, $params){
            $this->stmt->bind_param($format, ...$params);
        }
        function execute(){
            try{
                $this->stmt->execute();
            }
           catch(Exception $e) {
                echo $e;
            }
        }

        function query($query){
            return mysqli_query($this->db, $query);
        }
        function get_result(){
            return $this->stmt->get_result();
        }
    }
?>