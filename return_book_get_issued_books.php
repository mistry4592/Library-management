<?php
// Connect to your database
include 'db.php';

// Fetch issued books data from the database
$query = "SELECT * FROM issued_books";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Fetch data into an array
$issued_books = array();
while ($row = mysqli_fetch_assoc($result)) {
    $issued_books[] = $row;
}

// Close the connection
mysqli_close($conn);

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($issued_books);
?>
