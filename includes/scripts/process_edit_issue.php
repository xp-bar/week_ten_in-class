<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';

function processFormInputs(array $input): array
{
    $result = [];
    
    $result['name'] = $input['name'] ?? null;
    $result['date'] = $input['date'] ?? null;
    
    if (array_key_exists('published', $input) && $input['published'] === 'on') {
        $result['published'] = true;
    } else {
        $result['published'] = false;
    }

    // $result format: ['name' => (string), 'date' => (string), 'published' => (bool)]
    return $result;
}

function validateInputs(array $inputs): bool
{
    // add our individual field validations here;
    // i.e. name >=3 characters, is shorter than 40 characters, is not duplicated with an existing one, etc.
    //      date is in the future
    //      published is a boolean, etc.
    
    return true; // return whether or not we passed validation
}

function updateIssue(
    int $id,
    string $name,
    string $date,
    bool $published
): bool {
    $connection = getConnection();
    //                              name,     date,     published           id;
    $query = 'UPDATE issues SET name = ?, date = ?, published = ? WHERE id = ?;';

    // use the (int) cast to fix the type mismatch with booleans in the database
    $bindings  = [$name, $date, (int) $published, $id]; 
    $statement = mysqli_prepare($connection, $query);
    $success   = mysqli_stmt_execute($statement, $bindings);
    
    return $success;
}


$input = processFormInputs($_POST);

$id = intval($_GET['id'] ?? null);

if ($id === null || !is_int($id) || $id === 0) {
    http_response_code(404);
    echo '<a href="index.php">Go home</a>';
    exit('Error! Issue not found');
}

$validated = validateInputs($input);

if (!$validated) {
    // add errors to the session here, or in validateInputs, etc.
    header('Location: /week_ten_in-class/edit-issue.php?id=' . $id);
    exit;
}

$success = updateIssue($id, $input['name'], $input['date'], $input['published']);
header('Location: /week_ten_in-class/issue.php?id=' . $id);

