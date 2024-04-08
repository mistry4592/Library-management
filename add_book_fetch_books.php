<?php
include_once "db.php";

// Fetch all books from the database
$fetch_query = "SELECT `id`, `title`, `author`, `publisher`, `languages`, `description`, `quantity`, `price`, `status`, `conditions`, `cover_image` FROM `library_books`";
$result = $conn->query($fetch_query);

$books = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Return books data as JSON
echo json_encode($books);
?>
