<!-- to calculate the level based on the xp -->
<?php
    $exp = 1600; //pakiadd ung kukunin ung value sa database
    $level = floor($exp/100);//random computation and not finalized yet
    $exp = $exp % 100;
    //then iuupdate ung sql
    echo $level;
?>
