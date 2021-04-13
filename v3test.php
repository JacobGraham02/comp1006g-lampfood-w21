<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

// Check if form was submitted:


    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LfWjqgaAAAAABhz3RdbMyHjAsarcRjkGqXjAMcd';
    $recaptcha_response = $_POST['recaptcha_response'];
echo "Response: $recaptcha_response<br />";
    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    //var_export($recaptcha);
    // Take action based on the score returned:
    if ($recaptcha->score >= 0.5) {
        // Verified - send email
        echo "good";
    } else {
        // Not verified - show form error
        echo "bad";
    }

?>
</body>
</html>
