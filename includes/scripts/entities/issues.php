<?php

declare(strict_types=1);

require_once __DIR__ . '/../database.php';

/**
 * Get all the issues
 *
 * @param string|null $search - optional, and will scope to issues matching by name if passed
 * @return mysqli_result
 */
function getIssues(?string $search = null)
{
    if ($search) {
        return query('SELECT * FROM issues WHERE name LIKE ?;', ['%' . $search . '%']);
    }

    return query('SELECT * FROM issues;');
}

/**
 * Get a single issue
 *
 * @param int $id
 * @return array|null
 */
function getIssueById(int $id)
{
    if ($id < 1) {
        return null;
    }

    $queryResult = query('SELECT * FROM issues WHERE id = ?;', [$id]);
    if (!$queryResult) {
        return null;
    }

    $result = mysqli_fetch_assoc($queryResult);

    if (!$result) {
        return null;
    }
    
    return $result;
}

/**
 * Create a single issue
 *
 * @param string $name
 * @param string $date
 * @param bool $published
 * @return bool - was the record created or not?
 */
function addIssue(string $name, string $date, bool $published): bool
{
    $bindings    = [$name, $date, $published];
    $queryResult = query('INSERT INTO issues (name, date, published) VALUE (?, ?, ?);', $bindings);

    return (bool) $queryResult;
}

/**
 * Update a single issue
 *
 * @param int $id
 * @param string $name
 * @param string $date
 * @param bool $published
 * @return bool - was the record created or not?
 */
function updateIssue(int $id, string $name, string $date, bool $published): bool
{
    $bindings    = [$name, $date, $published, $id];
    $queryResult = query('UPDATE issues SET name = ?, date = ?, published = ? WHERE id = ?;', $bindings);

    return (bool) $queryResult;
}
