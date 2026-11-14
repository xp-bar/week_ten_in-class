<?php

require_once __DIR__ . '/includes/scripts/database.php';

// step 1: connect to database
// mysqli_connect() - just in a different file
$connection = getConnection();

$id = 1;

// step 2: run a query against our database
$queryResult = mysqli_query($connection, 'SELECT * FROM issues WHERE id = ' . $id . ';');

// get the issue from the query
// contrary to the other page, it's fine if we just load "everything", as "everything" should only
// be one row.

// 3. grab the single result
//$issue = mysqli_fetch_array($queryResult, MYSQLI_ASSOC);

// 3. alternatively, we can just use _assoc() instead of passing the flag
$issue = mysqli_fetch_assoc($queryResult);

echo '<pre><code>';
var_dump($issue);
echo '</code></pre>';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>Document</title>
    </head>
    <body>
        <header>
        </header>
        <main>
        </main>
        <footer>
        </footer>
        <script src="main.js"></script>
    </body>
</html>
