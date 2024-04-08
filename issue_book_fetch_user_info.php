<?php
// Include db.php for database connection
require_once 'db.php';

if(isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    // Prepare SQL statement to fetch user information
    $stmt = $conn->prepare("SELECT `fname`, `email`, `pno` FROM `users` WHERE `id` = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $user_info = $result->fetch_assoc();
        echo json_encode($user_info); // Send user info as JSON response
    } else {
        echo json_encode(array('error' => 'User not found'));
    }
} else {
    echo json_encode(array('error' => 'User ID not provided'));
}
?>
