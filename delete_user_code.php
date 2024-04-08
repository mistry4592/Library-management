<?php
// Include your database connection file
include 'db1.php';

// Check if ID parameter is provided
if(isset($_POST['id'])) {
    // Sanitize ID parameter to prevent SQL injection
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    try {
        // Prepare and execute DELETE statement
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->rowCount() > 0) {
            // If deletion was successful
            echo json_encode(array('success' => 'User deleted successfully'));
            exit; // Stop further execution
        } else {
            // If no rows were affected (no matching user found)
            echo json_encode(array('error' => 'No user found with ID ' . $id));
            exit; // Stop further execution
        }
    } catch(PDOException $e) {
        // Display error message if query fails
        echo json_encode(array('error' => 'Query failed: ' . $e->getMessage()));
        exit; // Stop further execution
    }
} else {
    // If ID parameter is not provided
    echo json_encode(array('error' => 'ID parameter is missing'));
    exit; // Stop further execution
}
?>
