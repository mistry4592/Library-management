<?php
// Database configuration
$dbHost = 'localhost'; // Change this to your database host
$dbUsername = 'root'; // Change this to your database username
$dbPassword = ''; // Change this to your database password
$dbName = 'libs'; // Change this to your database name

// Establish database connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
