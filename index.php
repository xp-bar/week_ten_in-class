<?php

require_once __DIR__ . '/includes/scripts/database.php';

// step 1: connect to database
// mysqli_connect() - just in a different file
$connection = getConnection();

// step 2: run a query against our database
$query = mysqli_query($connection, 'SELECT * FROM issues;');

// step 3: fetch all the results (not best practice, will discuss alternative shortly)
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

var_dump($results);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>PHP &amp; HTML</title>
    </head>
    <body>
        <header>
            <h1>PHP &amp; HTML</h1>
        </header>
        <main>
        </main>
        <footer>
        </footer>
        <script src="main.js"></script>
    </body>
</html>
