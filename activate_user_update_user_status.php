<?php
// Include your database connection file
include 'db1.php';

// Check if the required parameters are set
if (isset($_POST['id'], $_POST['action'])) {
    $userId = $_POST['id'];
    $action = $_POST['action'];

    // Validate action
    if ($action !== 'activate' && $action !== 'deactivate') {
        echo 'Invalid action.';
        exit;
    }

    try {
        // Update user status in the database
        $status = ($action === 'activate') ? 0 : 1; // Update based on your logic
        $stmt = $pdo->prepare("UPDATE users SET status = :status WHERE id = :id");
        $stmt->execute(['status' => $status, 'id' => $userId]);

        // Check if the update was successful
        if ($stmt->rowCount() > 0) {
            echo 'User status updated successfully.';
        } else {
            echo 'No changes were made to user status.';
        }
    } catch (PDOException $e) {
        echo 'Error updating user status: ' . $e->getMessage();
    }
} else {
    echo 'Required parameters are missing.';
}
?>
