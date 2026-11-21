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
 * @return mysqli_result|null
 */
function getIssueById(int $id)
{
    if ($id < 1) {
        return null;
    }

    $result = query('SELECT * FROM issues WHERE id = ?;', [$id]);
    if (!$result) {
        return null;
    }

    return $result;
}
