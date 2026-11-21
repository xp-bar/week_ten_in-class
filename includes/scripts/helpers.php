<?php

declare(strict_types=1);

function throwEntityNotFoundError()
{
    // set the response code
    http_response_code(404);
    // exit out with an error and print it to the browser
    echo '<p style="color:red">Error 404! Entity could not be found!</p>';
    echo '<a href="index.php">Go home</a>';
}
