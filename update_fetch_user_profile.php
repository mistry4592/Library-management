<?php
session_start();
include 'db.php'; // Include your database connection file

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT fname, lname, email, pno FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userInfo = $result->fetch_assoc();
    echo json_encode($userInfo);
    $stmt->close();
}
?>
