<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving your Registration...</title>
</head>
<body>
<?php
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

    // set up SQL INSERT
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);

    // hash the password & fill params
    $password = password_hash($password, PASSWORD_DEFAULT);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);

    // save to db
    $cmd->execute();

    // disconnect
    $db = null;

    // confirmation
    echo '<h1>Registration Saved</h1><p>Click <a href="login.php">Login</a> to enter the site</p>';
}
?>
</body>
</html>
