<?php
$host = "127.0.0.1";   // match phpMyAdmin config
$user = "root";         // root user
$pass = "";             // empty password
$port = 3307;           // your MySQL port from phpMyAdmin
$db   = "recipe_db";

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
