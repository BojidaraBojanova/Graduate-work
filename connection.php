<?php
    
    function dbConnect(){
        $servername = 'localhost';
        $user = 'root';
        $password = '';
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=gym", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
    
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
?>