<?php

class Database {

    public function getConnection() {
    
        $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
            return $pdo;
    
        }
    
    }

    $db = new Database;

    $pdo = $db->getConnection();

?>