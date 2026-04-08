<?php
require "includes/auth.php";

$_SESSION = [];
// Unset all session variables currently stored in memory
session_unset();
// Destroy the session completely on the server
session_destroy();
// Redirect the user back to the login page
header("location: login.php");

// User logged out successfully
exit();

?>