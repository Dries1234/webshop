<?php
    include_once("handler.php");

    class Database {
        private $servername = "database"; //docker sees database as the correct local url
        private $database = "webshop";
        private $username = "Webuser";
        private $password = "Lab2021";
        private ?mysqli $db = NULL;
        private mysqli_stmt $stmt;
    
        
        function __destruct()
        {
            if($this->db){
                mysqli_close($this->db);
            }
        }
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

        function insert_id(){
            return mysqli_insert_id($this->db);
        }
        function error(){
            return $this->db->error;
        }
    }
?>