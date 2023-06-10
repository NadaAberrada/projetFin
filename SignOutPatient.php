<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the desired page
header("Location: landingpage.php"); // Replace 'index.php' with the appropriate page
exit();
?>
