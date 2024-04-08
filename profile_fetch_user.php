<?php
session_start();
// Include the database connection
include 'db.php';

// Check if the user is logged in (check if the session variable is set)
if (isset($_SESSION['email'])) {
    // Retrieve the user ID from the session variable
    $userId = $_SESSION['email'];

    // Prepare and execute SQL query to fetch user profile data
    $sql = "SELECT `id`, `fname`, `lname`, `email`, `pass`, `pno`, `pro_img` FROM `users` WHERE `email` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user data was found
    if ($result->num_rows > 0) {
        // Fetch user data as an associative array
        $userData = $result->fetch_assoc();

        // Encode user data as JSON and send it as the response
        echo json_encode($userData);
    } else {
        // Send error response if user data was not found
        echo json_encode(['error' => 'User not found']);
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Send error response if user is not logged in
    echo json_encode(['error' => 'User is not logged in']);
}
?>
