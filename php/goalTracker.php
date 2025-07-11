<?php
    
    require('../sql/goals.php'); // This loads the $goals array


    $goalCounter = 0;
    
    for($i = 0; $i < count($goals); $i++){
        if($goalCounter >= 5) break; // limit to 5 goals
        if($goals[$i]['active'] == false) continue; //skip if inactive goal

        // Calculate the percentage of progress
        $totalRange =  $goals[$i]['goalValue'] - $goals[$i]['baseValue'];
        $progress = ($goals[$i]['currentValue'] - $goals[$i]['baseValue']) / $totalRange * 100;

        echo '<div>';
        echo '<p><strong>' . $goals[$i]['name'] . '</strong></p>';
        echo '<div class="progress-bar">';
        echo '<div class="progress-fill" style="width: '.$progress.'%;"></div>';
        echo '</div>';
        echo '<div>';
        echo '<p>From ' . $goals[$i]['baseValue'] . '</p>';
        echo '<p>To ' . $goals[$i]['goalValue'] . '</p>';
        echo '</div>';
        echo '</div>';
        $goalCounter++;
    }


?>