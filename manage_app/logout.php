<?php
ob_start();
session_start();
// remove session from variables
unset($_SESSION['session_icadmin']); 

// destroy all the session 
//session_destroy(); 


unset($_COOKIE['cookie_icadmin']);
setcookie('cookie_icadmin', '', time() - 525600); 
header('Location: login.php');
ob_end_flush();
?>