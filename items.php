<?php $pageTitle = "Grocery List";
include 'header.php'; ?>

<h1>Grocery List</h1>
<?php
    // session_start called in header above; only call once per page
    if (!empty($_SESSION['username'])) {
        echo '<a href="item-details.php">Add an Item</a>';
    }
?>

<section>
    <form>
        <input name="keyword" id="keyword" placeholder="Search Term" />
        <button class="btn btn-primary">Search</button>
    </form>
</section>

<?php
try {
    // 1. Connect to the db.  Host: 172.31.22.43, DB: dbNameHere, Username: usernameHere, PW: passwordHere
    include 'db.php';

    // check for search criteria
    $keyword = null;

    if (isset($_GET['keyword'])) { // if we have a keyword param value in url
        $keyword = $_GET['keyword'];
    }

    //  2. Write the SQL Query to read all the records from the artists table and store in a variable
    $sql = "SELECT items.*, categories.name AS category FROM items
        LEFT OUTER JOIN categories on items.categoryId = categories.categoryId";

    if ($keyword != null) {
        $sql .= " WHERE items.name LIKE :keyword";
    }

    // 3. Create a Command variable $cmd then use it to run the SQL Query
    $cmd = $db->prepare($sql);

    if ($keyword != null) {
        $keyword = '%' . $keyword . '%';
        $cmd->bindParam(':keyword', $keyword, PDO::PARAM_STR, 50);
    }

    $cmd->execute();

    // 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $items.  See for details.
    $items = $cmd->fetchAll();

    // 5. Use a foreach loop to iterate (cycle) through all the values in the $items variable.  Inside this loop, use an echo command to display the name of each item.  See https://www.php.net/manual/en/control-structures.foreach.php for details.
    // start an HTML table for formatting BEFORE the foreach loop
    echo '<table class="table table-striped table-light sortable">
        <thead>
            <th><a href="#">Category</a></th>
            <th><a href="#">Name</a></th>
            <th><a href="#">Quantity</a></th>
            <th></th>';

    if (!empty($_SESSION['username'])) {
        echo '<th>Actions</th>';
    }

    echo '</thead>';

    foreach ($items as $indItems) {
        // must use "return" to evaluate the confirm method to decide if the link should fire or not
        echo '<tr><td>' . $indItems['category'] . '</td>';

        if (!empty($_SESSION['username'])) {
            echo '<td><a href="item-details.php?itemId=' . $indItems['itemId'] .
                '">' . $indItems['name'] . '</a></td>';
        }
        else {
            echo '<td>' . $indItems['name'] . '</td>';
        }

        echo '<td>' . $indItems['quantity'] . '</td>';
        echo '<td>'; // show photo if any
        if (!empty($indItems['photo'])) {
            echo '<img src="img/item-uploads/' . $indItems['photo'] . '"
                alt="Item Photo" class="thumbnail" />';
        }
        echo '</td>';

        if (!empty($_SESSION['username'])) {
            echo '<td><a href="item-details.php?itemId=' . $indItems['itemId'] .
                '" class="btn btn-secondary">Edit</a>&nbsp;
                <a href="delete-item.php?itemId=' . $indItems['itemId'] .
                '" class="btn btn-danger" title="Delete"
                onclick="return confirmDelete();">Delete</a></td>';
        }
        echo '</tr>';
    }

    // close the table
    echo '</table>';

    // 6. Disconnect from the database
    $db = null;
}
catch (exception $e) {
    /* mail('me@email.com', 'Lamp Food Error', $e,
        'From:contact@lampfood.com'); */
    header('location:error.php');
}

include 'footer.php';
?>

