<?php

$username = "root";
$password = "";
$dbname = "333com";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $dbErr = "Connection failed: " . $conn->connect_error;
    die($dbErr);
}
