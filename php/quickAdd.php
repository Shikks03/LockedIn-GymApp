<?php
//for databasae injection
require_once(__DIR__ . '/../includes/session.php');
include(__DIR__ . '/../sqlConnection/database.php');
requireLogin(); // Force login

$user = getCurrentUser();

//post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $goalName = $_POST['goalName'] ?? '';
    $fromValue = $_POST['fromValue'] ?? '';
    $toValue = $_POST['toValue'] ?? '';

    try {
        $query = "INSERT INTO goals (user_id, goal_name, base, current, target, active) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user['user_id'], $goalName, $fromValue, $fromValue,$toValue,1]);
    }catch(PDOException $e){
        die("Insertion Error! : ". $e->getMessage());
    }

    // dito ilagay ung logic para i-save ung goal sa database

    // nageecho lng sya para makita na nakuha ung value
    echo "Goal added: $goalName ($fromValue → $toValue)";
    exit;
}

?>