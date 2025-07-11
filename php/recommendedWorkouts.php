<?php 
    require('../sql/workouts.php'); // Include the workouts array

    $used = array();
    for($i = 0; $i < 3; $i++){//generates 3 random workouts
        do{
            $recommendedWorkout = rand(0, count($workouts) - 1);
        }while(in_array($recommendedWorkout, $used));
        $used[] = $recommendedWorkout;

        echo '<div class="card">';
        echo '<div><h2>'.$workouts[$recommendedWorkout]["name"].'</h2></div>';
        echo '<img src="'.$workouts[$recommendedWorkout]["image"].'">';
        echo '</div>';
    }


?>