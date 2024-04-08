<?php
// Include db.php for database connection
require_once 'db.php';

// Prepare SQL statement to fetch book names
$stmt = $conn->prepare("SELECT `title` FROM `library_books`");
$stmt->execute();
$result = $stmt->get_result();

$book_names = array();
while($row = $result->fetch_assoc()) {
    $book_names[] = $row['title'];
}

echo json_encode($book_names); // Send book names as JSON response
?>
