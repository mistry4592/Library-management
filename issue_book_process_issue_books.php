<?php
// Include db.php for database connection
require_once 'db.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    
    // Get current date as issue date
    $issue_date = date("Y-m-d");
    // Calculate return date (e.g., 7 days from issue date)
    $return_date = date("Y-m-d", strtotime("+7 days"));

    // Prepare and execute INSERT query
    $stmt = $conn->prepare("INSERT INTO `issue_books` (`user_id`, `book_id`, `issue_date`, `return_date`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $book_id, $issue_date, $return_date);

    $stmt1 = $conn->prepare("UPDATE stock_books SET quantity = quantity - 1 WHERE id = $book_id");

    // UPDATE stock_books SET quantity = quantity - 1 WHERE id = 38
    if ($stmt->execute() && $stmt1->execute()) {
        // Issue successful, return success response
        echo json_encode(array('success' => true));
    } else {
        // Issue failed, return error response
        echo json_encode(array('success' => false));
    }
} else {
    // Handle case where form data is not submitted
    // For example, return error response
    echo json_encode(array('success' => false, 'error' => 'Form data not submitted.'));
}
?>
