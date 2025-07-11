<?php
    $dns = "mysql:host=localhost;dbname=lofit";
    $dbusername = "root";
    $dbpass = "";

    try{
        $pdo = new PDO($dns,$dbusername,$dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Database Connection Failed! : ".$e->getMessage();
    }