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

function createNewIssue(
    string $name,
    string $date,
    bool $published
): bool {
    $connection = getConnection();
    //                                                             (name, date, published)
    $query     = 'INSERT INTO issues (name, date, published) VALUE (?, ?, ?);';
    $bindings  = [$name, $date, $published];
    $statement = mysqli_prepare($connection, $query);
    $success   = mysqli_stmt_execute($statement, $bindings);
    
    return $success;
}


$input     = processFormInputs($_POST);
$validated = validateInputs($input);

if (!$validated) {
    // add errors to the session here, or in validateInputs, etc.
    header('Location: /week_ten_in-class/add-issue.php');
    exit;
}

$success = createNewIssue($input['name'], $input['date'], $input['published']);
header('Location: /week_ten_in-class/add-issue.php');

