<?php $pageTitle = "Grocery List";
include 'header.php'; ?>

<h1>Grocery List</h1>
<a href="item-details.php">Add an Item</a>
<?php
// 1. Connect to the db.  Host: 172.31.22.43, DB: dbNameHere, Username: usernameHere, PW: passwordHere
include 'db.php';

//  2. Write the SQL Query to read all the records from the artists table and store in a variable
$sql = "SELECT items.*, categories.name AS category FROM items 
    LEFT OUTER JOIN categories on items.categoryId = categories.categoryId";

// 3. Create a Command variable $cmd then use it to run the SQL Query
$cmd = $db->prepare($sql);
$cmd->execute();

// 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $items.  See for details.
$items = $cmd->fetchAll();

// 5. Use a foreach loop to iterate (cycle) through all the values in the $items variable.  Inside this loop, use an echo command to display the name of each item.  See https://www.php.net/manual/en/control-structures.foreach.php for details.
// start an HTML table for formatting BEFORE the foreach loop
echo '<table class="table table-striped table-light"><thead><th>Category<th>Name</th><th>Quantity</th></TH><th>Actions</th></thead>';

foreach ($items as $indItems)
{
    // must use "return" to evaluate the confirm method to decide if the link should fire or not
    echo '<tr><td>' . $indItems['category'] . '</td>
        <td><a href="item-details.php?itemId=' . $indItems['itemId'] .
        '">' . $indItems['name'] . '</a></td>
        <td>' . $indItems['quantity'] . '</td>
        <td><a href="item-details.php?itemId=' . $indItems['itemId'] .
            '" class="btn btn-secondary">Edit</a>&nbsp;
            <a href="delete-item.php?itemId=' . $indItems['itemId'] .
            '" class="btn btn-danger" title="Delete"
            onclick="return confirmDelete();">Delete</a></td></tr>';
}

// close the table
echo '</table>';

// 6. Disconnect from the database
$db = null;

include 'footer.php';
?>

