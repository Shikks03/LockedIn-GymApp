<!-- to calculate the level based on the xp -->
<?php
require_once(__DIR__ . '/../includes/session.php');
include(__DIR__ . '/../sqlConnection/database.php');
requireLogin(); // Force login

$user = getCurrentUser();


try {
    //RETRIEVE XP FROM DATABASE
    $query = 'SELECT xp FROM users WHERE user_id = ?'; //change to ? id session is implemented
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user['user_id']]);
    $exp = $stmt->fetchColumn();

    //INITIAL VALUES
    $level = 1;
    $requiredExp = 100;
    $remainingExp = $exp;

    //EACH LEVEL REQUIRES +100 more exp than the previous level
    while ($remainingExp >= $requiredExp) { //loop until current level is reached
        $remainingExp -= $requiredExp;
        $level++;                           //hanggat may remaining exp pa, tapos nareach yung required, maglelevel up
        $requiredExp = $requiredExp + 100;
    }

    //UPDATE LEVEL BASED ON THE COMPUTED ONE
    $query = 'UPDATE users SET level = ? WHERE user_id = ?'; 
    $stmt = $pdo->prepare($query);
    $stmt->execute([$level, $user['user_id']]); 

    echo "$level" . "<br>";
    //echo "XP points: $remainingExp/$requiredExp";
} catch (PDOException $e) {
    die("Database Connection Error!: " . $e->getMessage());
}

?>