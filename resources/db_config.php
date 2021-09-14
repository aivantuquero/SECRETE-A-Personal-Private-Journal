<?php
//establish a connection to the database
function connect()
{
    static $conn;
    if ($conn === null) {
        $conn = mysqli_connect('localhost', 'root', '', 'secretedb');
    }
    return $conn;
}