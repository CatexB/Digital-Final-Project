<?php

session_start();
 
// Check if the user is already logged in, if not, then redirect them to login page
header("location: /home.php");
?>
}