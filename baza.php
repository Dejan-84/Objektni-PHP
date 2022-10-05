<?php

function database_connection(string $servername, string $username, string $password, string $database)
{
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);   

    // Check connection
    if (!$conn) {

        return false;
    }

    return $conn;
}
