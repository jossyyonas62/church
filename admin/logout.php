<?php
session_start();

// 1. Clear all session variables
session_unset();

// 2. Destroy the session entirely
session_destroy();

// 3. Redirect back to the login page
header("Location: login.php");
exit();
?>