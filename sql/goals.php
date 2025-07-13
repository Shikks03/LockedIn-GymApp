<?php
require_once(__DIR__ . '/../includes/session.php');
requireLogin(); 
$user = getCurrentUser(); // 
$goals = [];

try {
    require_once(__DIR__ . '/../sqlConnection/database.php');

    //query part
    $query = "SELECT * FROM goals WHERE user_id = ?"; 
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user['user_id']]); 
    $results =$stmt->fetchAll(PDO::FETCH_ASSOC); //this will convert the database into an associative array

    //put the results into an associative array for easier retrieval on goalTracker.php
    foreach($results as $row){
        $goals[] = [
            'goal_id' => htmlspecialchars($row['goal_id']),
            'name' => htmlspecialchars($row['goal_name']), //these are individual columns in the database
            'baseValue' => htmlspecialchars((float)$row['base']),
            'currentValue' => htmlspecialchars((float)$row['current']),
            'goalValue' => htmlspecialchars((float)$row['target']),
            'active' => htmlspecialchars((bool)$row['active']),
        ];
    }
}catch(PDOException $e){
    echo "Database Connection Error!: ".$e->getMessage();
}