<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Details</title>
</head>
<body>
    <h1>Grocery Item</h1>
    <form method="post" action="save-item.php">
        <fieldset>
            <label for="name">Name: </label>
            <input name="name" id="name" required />
        </fieldset>
        <fieldset>
            <label for="quantity">Quantity: </label>
            <input name="quantity" id="quantity" required type="number" min="1" />
        </fieldset>
        <fieldset>
            <label for="categoryId">Category: </label>
            <select name="categoryId" id="categoryId">
                <?php
                // connect
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', '');

                // set up query to fetch categories
                $sql = "SELECT * FROM categories ORDER BY name";

                // set up & execute command
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $categories = $cmd->fetchAll();

                // loop through the results adding each category to the dropdown list
                foreach ($categories as $c) {
                    echo '<option value="' . $c['categoryId'] . '">' . $c['name'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <button>Save</button>
    </form>
</body>
</html>
