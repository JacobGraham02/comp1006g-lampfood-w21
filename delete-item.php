<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting item...</title>
</head>
<body>

<?php
if (is_numeric($_GET['itemId'])) {
    // read the itemId from the URL parameter using the $_GET collection
    $itemId = $_GET['itemId'];

    // connect
    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

    // set up & run the SQL DELETE command
    $sql = "DELETE FROM items WHERE itemId = :itemId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':itemId', $itemId, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $db = null;
}

// redirect to the updated items.php page. if no numeric itemId URL param, just reload anyway
header('location:items.php');
?>

</body>
</html>
