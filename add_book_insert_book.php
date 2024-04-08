<?php
include_once "db.php";

// Function to validate and sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to handle file upload
function upload_file($file) {
    $target_dir = "img/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size (if needed)
    // Check file type (if needed)

    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $title = sanitize_input($_POST["add_book_title"]);
    $author = sanitize_input($_POST["add_book_author_name"]);
    $publisher = sanitize_input($_POST["add_book_publisher"]);
    $languages = sanitize_input($_POST["add_book_language"]);
    // $description = sanitize_input($_POST["add_book_description"]);
    $quantity = intval($_POST["add_book_quantity"]);
    // $price = floatval($_POST["add_book_price"]);
    $status = intval($_POST["add_book_status"]);
    $condition = sanitize_input($_POST["add_book_condition"]);

    // Upload image
    $cover_image = "";
    if ($_FILES["add_book_cover_image"]["name"]) {
        $cover_image = upload_file($_FILES["add_book_cover_image"]);
    }

    // Check for duplicate entry
    $duplicate_check_query = "SELECT * FROM `library_books` WHERE `title` = '$title' AND `author` = '$author'";
    $duplicate_result = $conn->query($duplicate_check_query);
    if ($duplicate_result->num_rows > 0) {
        // Duplicate entry found, handle accordingly
        $response = array('status' => 'error', 'message' => 'Duplicate entry found.');
        echo json_encode($response);
    } else {
        // Insert data into the database
        $insert_query = "INSERT INTO `library_books` (`title`, `author`, `publisher`, `languages`, `quantity`, `status`, `conditions`, `cover_image`) VALUES ('$title', '$author', '$publisher', '$languages', $quantity, $status, '$condition', '$cover_image')";
        $insert_query1 = "INSERT INTO `stock_books` (`title`, `author`, `publisher`, `languages`, `quantity`, `status`, `conditions`, `cover_image`) VALUES ('$title', '$author', '$publisher', '$languages', $quantity, $status, '$condition', '$cover_image')";

        // Execute each query separately
        $result1 = $conn->query($insert_query);
        $result2 = $conn->query($insert_query1);

        // Check if both queries were successful
        if ($result1 === TRUE && $result2 === TRUE) {
            // Data inserted successfully into both tables
            $response = array('status' => 'success', 'message' => 'Book added successfully.');
            echo json_encode($response);
        } else {
            // Error inserting data
            $response = array('status' => 'error', 'message' => 'Error occurred while adding book.');
            echo json_encode($response);
        }

    }
}
?>
