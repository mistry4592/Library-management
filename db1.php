<?php
// Database configuration
$dbHost = 'localhost'; // Change this to your database host
$dbName = 'libs'; // Change this to your database name
$dbUsername = 'root'; // Change this to your database username
$dbPassword = ''; // Change this to your database password

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
