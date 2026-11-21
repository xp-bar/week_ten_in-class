<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>Add Issue</title>
    </head>
    <body>
        <header>
            <h1>Add a new issue</h1>
        </header>
        <main>
            <form action="includes/scripts/process_add_issue.php" method="POST">
                <div>
                    <label for="name">Issue Name:</label>
                    <input id="name" type="text" name="name">
                </div>

                <div>
                    <label for="date">Issue Date:</label>
                    <input id="date" type="date" name="date">
                </div>

                <div>
                    <label for="published">Issue is published?</label>
                    <input id="published" type="checkbox" name="published">
                </div>
                <div>
                    <button type="submit">Save</button>
                </div>
            </form>
        </main>
        <script src="main.js"></script>
    </body>
</html>
