<?php

require_once __DIR__ . '/includes/scripts/entities/issues.php';
require_once __DIR__ . '/includes/scripts/entities/articles.php';

$id    = array_key_exists('id', $_GET) ? intval($_GET['id']) : null;
$issue = $id !== null ? getIssueById($id) : null;

if (!$issue) {
    // set the response code
    http_response_code(404);
    // exit out with an error and print it to the browser
    echo '<a href="index.php">Go home</a>';
    exit('Error! Issue not found');
}

$articlesResult = getArticlesByIssueId($issue['id']);

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
            <a href="edit-issue.php?id=<?php echo $issue['id']; ?>">Edit Issue</a>
        </main>
        <footer>
            <a href="index.php">Home</a>
        </footer>
        <script src="main.js"></script>
    </body>
</html>
