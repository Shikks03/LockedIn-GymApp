<!-- to calculate the level based on the xp -->
<?php
include(__DIR__ . '/../sqlConnection/database.php');
try {
    //RETRIEVE XP FROM DATABASE
    $query = 'SELECT xp FROM users WHERE user_id = 6'; //change to ? id session is implemented
    $stmt = $pdo->prepare($query);
    $stmt->execute(/*[$_SESSION[user_id]*/);
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
    $stmt->execute([$level,6/*,$_SESSION[user_id]*/]); //remove 6 and uncomment when SESSIONS are implemented

    echo "$level" . "<br>";
    //echo "XP points: $remainingExp/$requiredExp";
} catch (PDOException $e) {
    die("Database Connection Error!: " . $e->getMessage());
}

?>