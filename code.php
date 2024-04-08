<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['role_name']) && !empty($_POST['pno']) && !empty($_POST['addhar']) && !empty($_FILES['profile_image'])) {
        
        // Database operations
        include_once "db.php"; // Include your database connection file

        // Fetch form data and perform XSS protection
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['pass']);
        $role_name = htmlspecialchars($_POST['role_name']);
        $pno = htmlspecialchars($_POST['pno']);
        $addhar = htmlspecialchars($_POST['addhar']);

        // Check if email already exists
        $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
        $result_email = $conn->query($check_email_sql);

        // Check if phone number already exists
        $check_phone_sql = "SELECT * FROM users WHERE pno = '$pno'";
        $result_phone = $conn->query($check_phone_sql);

        if ($result_email->num_rows > 0) {
            // Email already exists
            echo "Email already exists.";
        } elseif ($result_phone->num_rows > 0) {
            // Phone number already exists
            echo "Phone number already exists.";
        } else {
            // Function to validate email
            function isValidEmail($email) {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            }

            // Function to validate phone number
            function isValidPhoneNumber($pno) {
                return preg_match('/^\d{10}$/', $pno);
            }

            // Validate email
            if (!isValidEmail($email)) {
                echo "Invalid email address.";
                exit();
            }

            // Validate phone number
            if (!isValidPhoneNumber($pno)) {
                echo "Invalid phone number.";
                exit();
            }

            // Process profile image
            $profile_image_name = $_FILES['profile_image']['name'];
            $profile_image_temp = $_FILES['profile_image']['tmp_name'];
            $profile_image_ext = pathinfo($profile_image_name, PATHINFO_EXTENSION);
            $profile_image_path = "images/" . uniqid() . '.' . $profile_image_ext;

            // Validate image file type
            $allowed_image_types = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array(strtolower($profile_image_ext), $allowed_image_types)) {
                echo "Invalid profile image format. Only JPG, JPEG, PNG, and GIF are allowed.";
                exit();
            }

            // Move uploaded profile image to destination folder
            if (!move_uploaded_file($profile_image_temp, $profile_image_path)) {
                echo "Error uploading profile image.";
                exit();
            }

            // // Process Aadhar card upload
            // $aadhar_upload_name = $_FILES['aadhar_upload']['name'];
            // $aadhar_upload_temp = $_FILES['aadhar_upload']['tmp_name'];
            // $aadhar_upload_ext = pathinfo($aadhar_upload_name, PATHINFO_EXTENSION);
            // $aadhar_upload_path = "images/" . uniqid() . '.' . $aadhar_upload_ext;

            // // Validate Aadhar upload file type
            // $allowed_aadhar_types = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
            // if (!in_array(strtolower($aadhar_upload_ext), $allowed_aadhar_types)) {
            //     echo "Invalid Aadhar upload format. Only JPG, JPEG, PNG, GIF, and PDF are allowed.";
            //     exit();
            // }

            // // Move uploaded Aadhar upload to destination folder
            // if (!move_uploaded_file($aadhar_upload_temp, $aadhar_upload_path)) {
            //     echo "Error uploading Aadhar upload.";
            //     // Delete profile image uploaded earlier
            //     unlink($profile_image_path);
            //     exit();
            // }

            // Insert new record into users table
            $sql = "INSERT INTO users (fname, lname, email, pass, role, pno, addhar, pro_img, created_date, status) 
                    VALUES ('$fname', '$lname', '$email', '$pass', '$role_name', '$pno', '$addhar', '$profile_image_path',  NOW(), '1')";

            if ($conn->query($sql) === TRUE) {
                echo "New record inserted successfully.";
            } else {
                echo "Error inserting record into database.";
            }
        }

        // Close database connection
        $conn->close();
    } else {
        // Required fields are missing
        echo "All required fields are not provided.";
    }
} else {
    // Form is not submitted using POST method
    echo "Form submission method not allowed.";
}

?>
