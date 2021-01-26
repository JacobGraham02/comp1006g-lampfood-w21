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
            <input name="quantity" id="quantity" required type="number" />
        </fieldset>
        <button>Save</button>
    </form>
</body>
</html>
