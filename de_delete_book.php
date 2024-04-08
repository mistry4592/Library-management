<?php
// Include your database connection file
include 'db1.php';

// Check if book ID is provided in the request
if(isset($_POST['id'])) {
    // Sanitize the input to prevent SQL injection
    $bookId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute the SQL query to delete the book
    $stmt = $pdo->prepare("DELETE FROM library_books WHERE id = ?");
    $stmt1 = $pdo->prepare("DELETE FROM stock_books WHERE id = ?");
    if($stmt->execute([$bookId]) && $stmt1->execute([$bookId])) {
        // Book deleted successfully
        echo "Book with ID $bookId deleted successfully.";
    } else {
        // Error occurred while deleting book
        echo "Error: Unable to delete book with ID $bookId.";
    }
} else {
    // Book ID not provided in the request
    echo "Error: Book ID not provided.";
}
?>
