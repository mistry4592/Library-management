<?php
// Include your database connection file
include 'db1.php';

// Fetch library books from the database
$stmt = $pdo->query("SELECT * FROM library_books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if books data is empty
if (empty($books)) {
    echo json_encode(array('error' => 'No books found'));
    exit; // Stop further execution
}

// Encode the books data as JSON
$jsonData = json_encode($books);

// Check if encoding was successful
if ($jsonData === false) {
    // Handle JSON encoding error
    echo json_encode(array('error' => 'JSON encoding error: ' . json_last_error_msg()));
    exit; // Stop further execution
}

// Return the encoded JSON data
echo $jsonData;
?>
