<?php

require_once __DIR__ . '/includes/scripts/database.php';

$search = $_GET['search'] ?? null;

// step 1: connect to database
// mysqli_connect() - just in a different file
$connection = getConnection();

if (!$search) {
    // step 2: run a query against our database
    $queryResult = mysqli_query($connection, 'SELECT * FROM issues;');
} else if ($search) {
    // a BAD EXAMPLE of how to insert the search into our query
    // $query = 'SELECT * FROM issues WHERE name LIKE ' . $search . ';';

    $sanitizedInput = htmlspecialchars($search); // hello & world -> hello &amp; world
    
    // instead of executing a query right away, we can "prepare" it first,
    // which will allow PHP to handle the insertion of our custom strings / searches etc.
    // in a safer way.
    $statement = mysqli_prepare($connection, 'SELECT * FROM issues WHERE name LIKE ?;');
    // the array that we pass in as the second argument
    // is merged into the above statement in the same order the question marks appear
    $wildcardSearch = '%' . $search . '%';
    $success        = mysqli_stmt_execute($statement, [$wildcardSearch]);
    // query is: SELECT * FROM issues WHERE name LIKE '%search%';
    
    $queryResult = mysqli_stmt_get_result($statement);
}


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
            <h2>Issues</h2>
            <form action="index.php" method="GET">
                <label for="search">Search:</label>
                <input 
                    id="search" 
                    name="search" 
                    type="text" 
                    placeholder="Search for an issue"
                    value="<?php echo $search; ?>"
                >
                <button type="submit">Go!</button>
            </form>
            <ul>
                <!-- loop over each result from our query -->
                <!-- while (): endwhile; -->
                <!-- while () {} -->
                <!-- the reason we use mysqli_fetch_array instead of fetch_all is that this loads the next
                record every time we call it.
                From previous lectures, we talked about how the () in a "while" are called every loop
                at the _start_ of the loop

                when we call mysqli_fetch_array for the FIFTH time in this loop,
                it returns `null`, which is "falsy" and the while loop stops
                -->
                <?php while ($issue = mysqli_fetch_array($queryResult)): ?>
                <li>
                    <article>
                        <!-- and print the name -->
                        <h3>
                            <a href="issue.php?id=<?php echo $issue['id']; ?>">
                                <?php echo $issue['name']; ?>
                            </a>
                        </h3>
                    </article>
                </li>
                <?php endwhile; ?>
            </ul>
        </main>
        <footer>
        </footer>
        <script src="main.js"></script>
    </body>
</html>
