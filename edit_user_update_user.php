<?php
// Include your database connection file
include 'db1.php';

// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user ID is set and not empty
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        try {
            // Prepare an SQL statement to update the user data
            $stmt = $pdo->prepare("UPDATE `users` SET `fname` = :fname, `lname` = :lname, `email` = :email, `pass` = :pass, `role` = :role, `pno` = :pno, `addhar` = :addhar, `status` = :status WHERE `id` = :id");

            // Bind the parameters
            $stmt->bindParam(':fname', $_POST['fname']);
            $stmt->bindParam(':lname', $_POST['lname']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':pass', $_POST['pass']);
            $stmt->bindParam(':role', $_POST['role']);
            $stmt->bindParam(':pno', $_POST['pno']);
            $stmt->bindParam(':addhar', $_POST['addhar']);
            $stmt->bindParam(':status', $_POST['status']);
            $stmt->bindParam(':id', $_POST['id']);

            // Execute the statement
            $stmt->execute();

            // Return success message
            echo "User updated successfully.";
        } catch(PDOException $e) {
            // Display error message if query fails
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Return error message if user ID is not set or empty
        echo "Error: User ID is required.";
    }
} else {
    // Return error message if form data is not submitted using POST method
    echo "Error: Form data not submitted.";
}
?>
