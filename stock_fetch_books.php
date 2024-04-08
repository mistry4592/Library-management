<?php
include 'db.php'; // Include your database connection

// Fetch books data from the database
$sql = "SELECT `id`, `title`, `author`, `publisher`, `languages`, `description`, `quantity`, `price`, `status`, `conditions`, `cover_image` FROM `stock_books`";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    $books = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($books); // Return books data as JSON
} else {
    echo json_encode([]); // Return an empty array if no books found
}

// Close database connection
$conn->close();
?>
