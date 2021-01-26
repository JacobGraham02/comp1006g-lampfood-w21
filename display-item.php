<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grocery Item</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>
<body>
<h1>Item Details</h1>

<?php
// get the selected dropdown option from the POST array
$itemId = $_POST['itemId'];

// connect
$db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');

// set up the query to retrieve the selected item using a bound parameter for safety
$sql = "SELECT * FROM items WHERE itemId = :itemId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':itemId', $itemId, PDO::PARAM_INT);

// execute the query & store the result using fetch()
$cmd->execute();
$item = $cmd->fetch();

// display the record
echo '<h5>Name: ' . $item['name'] . '</h5>';
echo '<h5>Quantity: ' . $item['quantity'] . '</h5>';

// disconnect
$db = null;
?>

</body>
</html>
