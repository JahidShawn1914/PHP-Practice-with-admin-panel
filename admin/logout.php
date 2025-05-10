<?php

session_start();
if (isset($_SESSION['auth']) || isset($_COOKIE['auther'])) {

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // cookie unset
    if (isset($_COOKIE['auther'])) {
        setcookie('auther', '', time() - 3600, "/");
    }

    // Redirect to login page
    header("Location: login.php");
    exit;
} 
else {
    // If the user is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>