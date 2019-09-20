<?php

        require_once "./src/files/connection.php";
    
        $conn = new Connection("test", "mysql", "localhost", "root", "root");
    
        var_dump($conn->conn);
    
    ?>