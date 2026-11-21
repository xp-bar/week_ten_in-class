<?php

declare(strict_types=1);

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

$input = processFormInputs($_POST);

var_dump($input);
exit;
