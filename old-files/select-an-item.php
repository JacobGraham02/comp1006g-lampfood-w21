<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fill dropdown from Database Query</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>
<body>

<form method="post" action="display-item.php">
    <fieldset>
        <label for="itemId">Choose an Item:</label>
        <select name="itemId" id="itemId">
            <?php
            // 1. connect
            $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');

            // 2. write the query
            $sql = "SELECT itemId, name FROM items";

            // 3. set up the command, execute query & store results data
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $items = $cmd->fetchAll();

            // 4. loop through the data, and a new item to the dropdown for each one
            foreach ($items as $item) {
                echo '<option value="' . $item['itemId'] . '">' . $item['name'] . '</option>';
            }

            // 5. disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <button class="btn btn-primary">Find</button>
</form>

</body>
</html>
