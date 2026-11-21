<?php

require_once __DIR__ . '/includes/scripts/database.php';

// step 1: connect to database
// mysqli_connect() - just in a different file
$connection = getConnection();

$id = $_GET['id'] ?? null;
$id = intval($id);

if ($id === null || !is_int($id) || $id === 0) {
    // set the response code
    http_response_code(404);
    // exit out with an error and print it to the browser
    echo '<a href="index.php">Go home</a>';
    exit('Error! Issue not found');

    // alternatively, we could redirect to a "404.php" or something similar,
    // with a nicer looking error page,
    // and on THAT page, we would call http_response_code(404); and then print out our nicer
    // error page.
    // header('Location: 404.php');
}

// step 2: run a query against our database ==========================================================
// step 2a: prepare the query with the wildcards
$statement = mysqli_prepare($connection, 'SELECT * FROM issues WHERE id = ?;');

// step 2b: execute the query replacing the wildcards with the array values in order
$success = mysqli_stmt_execute($statement, [$id]);

// step 2c: convert the now-executed statement into a mysqli result object so we can iterate over it.
$queryResult = mysqli_stmt_get_result($statement);
// ===================================================================================================

// get the issue from the query
// contrary to the other page, it's fine if we just load "everything", as "everything" should only
// be one row.

// 3. grab the single result
//$issue = mysqli_fetch_array($queryResult, MYSQLI_ASSOC);

// 3. alternatively, we can just use _assoc() instead of passing the flag
$issue = mysqli_fetch_assoc($queryResult);

//if ($issue === null) {
if (!$issue) {
    http_response_code(404);
    echo '<a href="index.php">Go home</a><br>';
    exit('Error! Issue not found');
}

// we could use $id, but if it was a different field on $issue that we needed, we would grab instead
// like this instead
$issueId = $issue['id'];

$statement      = mysqli_prepare($connection, 'SELECT * FROM articles WHERE issue_id = ?;');
$success        = mysqli_stmt_execute($statement, [$issueId]);
$articlesResult = mysqli_stmt_get_result($statement);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="main.css">
        <!-- don't just use the name of the record, 
        use some context that is consistent in the title as well -->
        <title>Issues - <?php echo $issue['name']; ?></title>
    </head>
    <body>
        <header>
            <h1><?php echo $issue['name']; ?></h1>
        </header>
        <main>
            <h2>Articles</h2>
            <ul>
                <?php while ($article = mysqli_fetch_assoc($articlesResult)) { ?>
                <li>
                    <article>
                        <h3><?php echo $article['headline']; ?></h3>
                        <p><?php echo $article['slug']; ?></p>
                    </article>
                </li>
                <?php } ?>
            </ul>
        </main>
        <footer>
            <a href="index.php">Home</a>
        </footer>
        <script src="main.js"></script>
    </body>
</html>
