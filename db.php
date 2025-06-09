<?php

    class Database{
        public $conn;
        function connection(){
            $dsn="mysql:host=localhost;dbname=virat;port=3308";
            return $this->conn=new PDO($dsn,"root","");
        }
        // public $arrdata;
        
    }
    $db=new Database();
?>