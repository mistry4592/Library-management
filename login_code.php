<?php
session_start();

// Include the db.php file to establish database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to check if the user exists and is active
    $sql = "SELECT * FROM users WHERE email = '$email' AND status = 0"; // Assuming 0 means active
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Check if the password matches
        if ($password == $row['pass']) {
            // Password matches, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role']; // Assuming role is fetched from the database
            $_SESSION['id'] = $row['id'];

            
            // Redirect based on the user's role
            if ($_SESSION['role'] == 'Admin') {
                header('Location: index.php');
            } else {
                header('Location: user_index.php');
            }
            exit(); // Make sure to exit after redirection
        } else {
            // Password is incorrect
            $_SESSION['error'] = "Incorrect password";
            header('Location: login.php');
            exit();
        }
    } else {
        // User does not exist or is not active
        $_SESSION['error'] = "User does not exist or is not active";
        header('Location: login.php');
        exit();
    }
}
?>
