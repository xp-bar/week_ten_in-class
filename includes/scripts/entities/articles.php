<?php

declare(strict_types=1);

require_once __DIR__ . '/../database.php';

function getArticlesByIssueId(int $issueId)
{
    if ($issueId < 1) {
        return null;
    }

    $queryResult = query('SELECT * FROM articles WHERE issue_id = ?;', [$issueId]);
    if (!$queryResult) {
        return null;
    }

    return $queryResult;
}
