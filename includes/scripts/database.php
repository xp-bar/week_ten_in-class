<?php

declare(strict_types=1);

function getConnection()
{
    // mac:
    $hostname = 'localhost';

    // windows:
    //$hostname = '127.0.0.1'; // potentially may need to use this host if localhost is not working
    
    $username = 'root';

    // mac password:
    $password = 'root';

    // windows password
    //$password = '';
    
    $database = 'digital_magazine';

    // mac port:
    $port = 8889;

    // windows port:
    //$port = 3306;

    return mysqli_connect($hostname, $username, $password, $database, $port);
}
