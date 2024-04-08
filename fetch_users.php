<?php
// Include database connection
include 'db.php';

// Fetch users from the database
$query = "SELECT `id`, `fname`, `lname`, `email`, `pass`, `role`, `pno`, `addhar`, `status` FROM `users`";
$result = $conn->query($query);

// Prepare data array
$data = array();

// Fetch data and format for datatable
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'id' => $row['id'],
            'name' => $row['fname'] . ' ' . $row['lname'],
            'email' => $row['email'],
            'role' => $row['role'],
            'phone' => $row['pno'],
            'aadhar' => $row['addhar'],
            'status' => $row['status']
        );
    }
}

// Close database connection
$conn->close();

// Return data as JSON
echo json_encode(array('data' => $data));
?>
