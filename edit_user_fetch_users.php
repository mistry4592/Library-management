<?php
// Include your database connection file
include 'db1.php';

try {
    // Fetch user data from the database
    $stmt = $pdo->query("SELECT `id`, `fname`, `lname`, `email`, `pass`, `role`, `pno`, `addhar`, `status` FROM `users`");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if users data is empty
    if (empty($users)) {
        echo json_encode(array('error' => 'No users found'));
        exit; // Stop further execution
    }

    // Encode the users data as JSON
    $jsonData = json_encode($users);

    // Check if encoding was successful
    if ($jsonData === false) {
        // Handle JSON encoding error
        echo json_encode(array('error' => 'JSON encoding error: ' . json_last_error_msg()));
        exit; // Stop further execution
    }

    // Return the encoded JSON data
    echo $jsonData;
} catch(PDOException $e) {
    // Display error message if query fails
    echo json_encode(array('error' => 'Query failed: ' . $e->getMessage()));
}
?>
