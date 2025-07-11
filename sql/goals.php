<?php
$goals = [];

try {
    require_once(__DIR__ . '/../sqlConnection/database.php');

    //query part
    $query = "SELECT goal_name, base, current, target, active FROM goals WHERE user_id = 6"; //substite ? with the logged in user //CHANGE 6 TO ? PAG MAY SESSION NA
    $stmt = $pdo->prepare($query);
    $stmt->execute(/*[$_SESSION['user_id']]*/); //UNCOMMENT THIS PAG GUMAGANA NA YUNG SESSION
    $results =$stmt->fetchAll(PDO::FETCH_ASSOC); //this will convert the database into an associative array

    //put the results into an associative array for easier retrieval on goalTracker.php
    foreach($results as $row){
        $goals[] = [
            'name' => $row['goal_name'], //these are individual columns in the database
            'baseValue' => (float)$row['base'],
            'currentValue' => (float)$row['current'],
            'goalValue' => (float)$row['target'],
            'active' => (bool)$row['active'],
        ];
    }
}catch(PDOException $e){
    echo "Database Connection Error!: ".$e->getMessage();
}