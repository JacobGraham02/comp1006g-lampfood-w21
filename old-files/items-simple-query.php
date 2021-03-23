<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Items Simple Query</title>
</head>
<body>

<?php

// 1. Connect to the db.  Host: 172.31.22.43, DB: dbNameHere, Username: usernameHere, PW: passwordHere

$user = 'Rich100';

$database = 'Rich100';

$passw = 'x';

try {

$db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $passw);

} catch (PDOException $e) {

echo "Error when connecting to database: " . $e->getMessage();

die();

}

//  2. Write the SQL Query to read all the records from the artists table and store in a variable

$sql = "SELECT * FROM items";



// 3. Create a Command variable $cmd then use it to run the SQL Query

$cmd = $db->prepare($sql);

$cmd->execute();



// 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $items.  See for details.


$items = $cmd->fetchAll();





// 5. Use a foreach loop to iterate (cycle) through all the values in the $items variable.  Inside this loop, use an echo command to display the name of each item.  See https://www.php.net/manual/en/control-structures.foreach.php for details.

foreach ($items as $indItems)

{

    echo 'Item Name: ' . $indItems['name'];

}





// 6. Disconnect from the database

$db = null;

?>

</body>
</html>
