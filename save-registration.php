<?php
$pageTitle = "Registering...";
include 'header.php';

// store the user's input in a variable (optional but recommended by simplicity)
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if (empty($username)) {
    echo 'Username required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

// save if valid
if ($ok) {
    // connect
    include 'db.php';
        // check username doesn't already exist
        $sql = "SELECT userId FROM users WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $cmd->execute();
        $user = $cmd->fetch();

        if ($user) {
            echo '<p class="alert alert-danger">User already exists</p>';
        }
        else {
            // set up SQL INSERT
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $cmd = $db->prepare($sql);

            // hash the password & fill params
            $password = password_hash($password, PASSWORD_DEFAULT);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);

            // save to db
            $cmd->execute();

            // confirmation
            echo '<h1>Registration Saved</h1><p>Click <a href="login.php">Login</a> to enter the site</p>';
        }

        // disconnect
        $db = null;
}

include 'footer.php';
?>

