<?php
try {
    require('../sql/goals.php'); // Include the goals array
    require_once(__DIR__ . '/../sqlConnection/database.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if form inputs are received
        if (isset($_POST['goal_id']) && isset($_POST['progress'])) { //retrieved goal id from array so sunod sunod lang yan
            $goalId = $_POST['goal_id'];
            $current = $_POST['progress'];

            // UPDATE PROGRESS
            $query = "UPDATE goals SET current = ? WHERE user_id = ? AND goal_id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$current, 6, $goalId]); // Static user_id for now; replace with session
        }
    }
} catch (PDOException $e) {
    die("Database Connection Error!: " . $e->getMessage());
}
?>

<?php
$cardCounter = 0;

for ($i = 0; $i < count($goals); $i++) {
    if ($cardCounter >= 5) break; // limit to 5 cards
    if (!$goals[$i]["active"]) continue; // skip inactive logs

    // card display
    echo '<form method="POST">'; // wrap each card in its own form
    echo '<div class="card">';
    echo '<p>' . htmlspecialchars($goals[$i]["name"]) . '</p>';
    echo '<p><input type="text" class="txt-input" name="progress" placeholder="record:" required></p>'; // Changed text to number para mas valid yung user input
    echo '<input type="hidden" name="goal_id" value="' . $goals[$i]['goal_id'] . '">'; // HIDDEN JUST TO TRACK GOAL ID AND UPDATE TO CORRESPONDING FIELD
    echo '<input type="submit" class="log" value="Update">';
    echo '</div>';
    echo '</form>'; 
    $cardCounter++;
}
?>
