<?php
// Include database connection and any necessary functions
include 'db.php'; // Include your database connection file here

// Check if email is set in POST data
if(isset($_POST['email'])) {
    // Sanitize the email address (validate email address here if necessary)
    $email = $_POST['email'];

    // Generate a strong password (you can use a function to generate a random password)
    $newPassword = generateStrongPassword();

    // Store the new password in the database along with the user's email
    // You'll need to replace 'users' with your actual table name
    $sql = "UPDATE users SET pass = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newPassword, $email);

    if ($stmt->execute()) {
        // Return the generated password
        echo $newPassword;
    } else {
        // Handle error if unable to update password
        echo 'Error: Failed to update password';
    }

    // Close prepared statement
    $stmt->close();
} else {
    // Handle error if email is not set
    echo 'Error: Email not provided';
}

// Close database connection
$conn->close();

// Function to generate a strong password
function generateStrongPassword() {
    // Generate a random password (you can customize the length and characters used)
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr(str_shuffle($chars), 0, 12); // Generate a 12-character password
    return $password;
}
?>