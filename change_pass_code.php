<?php
session_start();
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $oldPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the new password matches the confirm password
    if ($newPassword === $confirmPassword) {
        // Verify if the old password matches the password in the database
        $verifySql = "SELECT `id`, `pass` FROM `users` WHERE `email` = ?";
        $verifyStmt = $conn->prepare($verifySql);
        $verifyStmt->bind_param("s", $email);
        $verifyStmt->execute();
        $result = $verifyStmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user && $oldPassword === $user['pass']) {
            // Update the password in the database
            $updateSql = "UPDATE `users` SET `pass` = ? WHERE `email` = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $newPassword, $email);
            if ($updateStmt->execute()) {
                echo 'success'; // Password updated successfully
            } else {
                echo 'Failed to update password.';
            }
        } else {
            echo 'Incorrect old password.';
        }
    } else {
        echo 'New password and confirm password do not match.';
    }
}
?>
