<?php
// Include database connection file
include_once "db.php";

$action = $_GET['action'] ?? '';

// Perform CRUD operations based on action
if ($action == "add") {
    $catName = $_POST['catName'];
    // XSS protection - Sanitize user input
    $catName = htmlspecialchars($catName);
    
    $sql = "INSERT INTO cat (cat_name) VALUES ('$catName')";
    if ($conn->query($sql) === TRUE) {
        echo "Category added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($action == "edit") {
    $catId = $_POST['editCatId'];
    $catName = $_POST['editCatName'];
    // XSS protection - Sanitize user input
    $catName = htmlspecialchars($catName);

    $sql = "UPDATE cat SET cat_name='$catName' WHERE id='$catId'";
    if ($conn->query($sql) === TRUE) {
        echo "Category updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($action == "delete") {
    $catId = $_POST['catId'] ?? ''; // Ensure catId is set, else set to empty string to avoid undefined index error

    if ($catId != '') {
        $sql = "DELETE FROM cat WHERE id='$catId'";
        if ($conn->query($sql) === TRUE) {
            echo "Category deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: catId parameter not provided";
    }
} else {
    $sql = "SELECT id, cat_name FROM cat";
    $result = $conn->query($sql);

    $cats = array();
    while ($row = $result->fetch_assoc()) {
        $cats[] = $row;
    }
    echo json_encode(array("data" => $cats));
}

// Close database connection
$conn->close();
?>
