<?php
// Include the database connection
include 'db.php';

// Check if the ID parameter is set in the POST request
if (isset($_POST['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = $_POST['id'];

    // Update the status of the returned book in the database
    $sql_update_status = "UPDATE issue_books SET status = 'Returned' WHERE id = ?";
    $stmt_update_status = $conn->prepare($sql_update_status);
    $stmt_update_status->bind_param("i", $id);

    // Decrease the quantity of the book in stock
    $bookId = $_POST['bookId'];
    $sql_update_stock = "UPDATE stock_books SET quantity = quantity + 1 WHERE id = ?";
    $stmt_update_stock = $conn->prepare($sql_update_stock);
    $stmt_update_stock->bind_param("i", $bookId);

    if ($stmt_update_status->execute() && $stmt_update_stock->execute()) {
        // Return success response
        echo json_encode(['success' => true]);
    } else {
        // Return error response
        echo json_encode(['success' => false, 'message' => 'Failed to update status or stock quantity']);
    }

    // Close prepared statements
    $stmt_update_status->close();
    $stmt_update_stock->close();
} else {
    // Return error response if ID parameter is not set
    echo json_encode(['success' => false, 'message' => 'ID parameter is missing']);
}

// Close database connection
$conn->close();
?>
