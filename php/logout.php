<?php
session_start();
session_unset();      // Clear all session variables
session_destroy();    // Destroy the session for log out

header("Location: ../index.php");
exit;