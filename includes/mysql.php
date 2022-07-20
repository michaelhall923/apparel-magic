<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "apparel_magic";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 