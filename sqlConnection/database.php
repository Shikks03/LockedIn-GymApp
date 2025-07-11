<!-- 
 This is just a php file to connect database in to our system 
 ** remember to use include 'database.php'; before you query **
 -->
 

<?php
    $dsn = "mysql:host=localhost;dbname=lofit;charset=utf8mb4";
    $dbusername = "root";
    $dbpass = "";

    try{
        $pdo = new PDO($dsn,$dbusername,$dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die ("Database Connection Failed! : ".$e->getMessage());
    }