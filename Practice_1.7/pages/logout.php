<?php
session_start(); // Start the session

// Destroy all session variables
session_unset();

// Destroy the session itself
session_destroy();

// Redirect to the login page (or homepage)
header("Location: index.html");
exit();
?>
