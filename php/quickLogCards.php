<!-- to get and update a quicklog to the database -->

<?php
    $cardCounter = 0;
    require('../sql/goals.php'); // Include the goals array
    for($i = 0; $i < count($goals); $i++){
        if($cardCounter >= 5) break; // limit to 5 cards
        if(!$goals[$i]["active"]) continue; // skip inactive logs
        // card display
        echo '<div class="card">';
        echo '<p>'.$goals[$i]["name"].'</p>';
        echo '<p><input type="text" class="txt-input" placeholder="some php shi"></p>';
        echo '<input type="submit" class="log">';
        echo '</div>';
        $cardCounter++;
    }
?>