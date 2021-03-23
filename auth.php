<?php
// check if user is authenticated; if not, redirect to login

// access the current session - needed to read/write session variable
session_start();

// check if this user's username is stored in a session variable
if (empty($_SESSION['username'])) {
    // if not, go to login and stop the rest of the page execution
    header('location:login.php');
    exit();
}
?>