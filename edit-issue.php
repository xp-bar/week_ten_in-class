<?php

require_once __DIR__ . '/includes/scripts/database.php';

$id = $_GET['id'] ?? null;
$id = intval($id);

if ($id === null || !is_int($id) || $id === 0) {
    http_response_code(404);
    echo '<a href="index.php">Go home</a>';
    exit('Error! Issue not found');
}

// this probably belongs down here;
// if the ID above is invalid
// why would we bother opening a connection to the DB?
$connection = getConnection();

$statement   = mysqli_prepare($connection, 'SELECT * FROM issues WHERE id = ?;');
$success     = mysqli_stmt_execute($statement, [$id]);
$queryResult = mysqli_stmt_get_result($statement);
// we have our issue object
$issue = mysqli_fetch_assoc($queryResult);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>Edit Issue - <?php echo $issue['name']; ?></title>
    </head>
    <body>
        <header>
            <h1>Edit Issue: <?php echo $issue['name']; ?></h1>
        </header>
        <main>
            <form action="includes/scripts/process_edit_issue.php?id=<?php echo $issue['id']; ?>" method="POST">
                <div>
                    <label for="name">Issue Name:</label>
                    <input id="name" type="text" name="name" value="<?php echo $issue['name']; ?>">
                </div>

                <div>
                    <label for="date">Issue Date:</label>
                    <input id="date" type="date" name="date" value="<?php echo $issue['date']; ?>">
                </div>

                <div>
                    <label for="published">Issue is published?</label>
                    <input id="published" type="checkbox" name="published" <?php if ($issue['published']) { echo 'checked'; } ?>>
                </div>
                <div>
                    <button type="submit">Save</button>
                </div>
            </form>
        </main>
        <script src="main.js"></script>
    </body>
</html>
