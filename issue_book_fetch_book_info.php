<?php
// Include db.php for database connection
require_once 'db.php';

if(isset($_POST['book_name']) && !empty($_POST['book_name'])) {
    $book_name = $_POST['book_name'];
    
    // Prepare SQL statement to fetch book ID based on book name
    $stmt = $conn->prepare("SELECT `id` FROM `library_books` WHERE `title` = ?");
    $stmt->bind_param("s", $book_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $book_info = $result->fetch_assoc();
        echo json_encode($book_info); // Send book ID as JSON response
    } else {
        echo json_encode(array('error' => 'Book not found'));
    }
} else {
    echo json_encode(array('error' => 'Book name not provided'));
}
?>
