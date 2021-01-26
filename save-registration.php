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

// display the username value entered in the form from the $_POST array
echo '<p>Your username is: ' . $username . '</p>';
echo "<p>Your username is: $username</p>";
?>
</body>
</html>
