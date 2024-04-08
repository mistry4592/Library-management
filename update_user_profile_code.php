<?php
session_start();
include 'db.php'; // Include your database connection file

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pno = $_POST['pno'];

    $sql = "UPDATE users SET fname = ?, lname = ?, pno = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fname, $lname, $pno, $email);
    if($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
}
?>
