<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $goalName = $_POST['goalName'] ?? '';
    $fromValue = $_POST['fromValue'] ?? '';
    $toValue = $_POST['toValue'] ?? '';

    // dito ilagay ung logic para i-save ung goal sa database
    
    // nageecho lng sya para makita na nakuha ung value
    echo "Goal added: $goalName ($fromValue → $toValue)";
    exit;
}

?>
