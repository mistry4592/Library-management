<?php
// Include database connection
include_once 'db1.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize response array
    $response = array();

    // Check if book ID is provided
    if (isset($_POST['id'])) {
        // Sanitize and validate input data
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $languages = $_POST['languages'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $conditions = $_POST['conditions'];

        // Update book details in the database
        try {
            $sql = "UPDATE library_books SET title=?, author=?, publisher=?, languages=?, quantity=?, status=?, conditions=? WHERE id=?";
            $sql1 = "UPDATE stock_books SET title=?, author=?, publisher=?, languages=?,  quantity=?, status=?, conditions=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt1 = $pdo->prepare($sql1);
            $stmt->execute([$title, $author, $publisher, $languages, $quantity, $status, $conditions, $id]);
            $stmt1->execute([$title, $author, $publisher, $languages, $quantity, $status, $conditions, $id]);
            // Success message
            $response['status'] = 'success';
            $response['message'] = 'Book details updated successfully';
        } catch (PDOException $e) {
            // Error message
            $response['status'] = 'error';
            $response['message'] = 'Error updating book details: ' . $e->getMessage();
        }
    } else {
        // Error message if book ID is not provided
        $response['status'] = 'error';
        $response['message'] = 'Book ID is required';
    }

    // Send JSON response
    echo json_encode($response);
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
