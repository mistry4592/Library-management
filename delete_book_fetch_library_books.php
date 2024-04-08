<?php
// Include your database connection file
include 'db.php';
try {
    // Fetch library books from the database
    $query = "SELECT * FROM library_books";
    $result = mysqli_query($conn, $query);

    // Check if books data is empty
    if (mysqli_num_rows($result) == 0) {
        echo json_encode(array('error' => 'No books found'));
        exit; // Stop further execution
    }

    // Fetch all rows as associative array
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
} catch(Exception $e) {
    // Handle database connection error
    echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
    exit; // Stop further execution
} finally {
    // Close the database connection
    mysqli_close($conn);
}
?>