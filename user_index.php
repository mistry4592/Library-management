<?php
    session_start();
    include 'inc/red_auth.php';
    echo $headerContent = "User Index";
    include 'inc/user_head.php';
?>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-head">
                <h2></h2>
            </div>
            <div class="card-progress">
                <center>
                    <h2>
                        Home
                        <!-- <?php echo $_SESSION['id']; ?> -->
                    </h2>
                </center>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-head">
                <h2></h2>
            </div>
            <div class="card-progress">
                <center>
                    <h2>Issue Book </h2>
                </center>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-head">
                <h2></h2>
            </div>
            <div class="card-progress">
                <center>
                    <h2>Pending Book</h2>
                </center>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-head">
                <h2></h2>
            </div>
            <div class="card-progress">
                <center>
                    <h2>Books Stock</h2>
                </center>
            </div>
        </div>
    </div>
</div>
<?php

// Include the database connection
include 'db.php';

// Fetch only "Issued" books from the database for the logged-in user
$userId = $_SESSION['id']; // Get the user ID from the session
$sql = "SELECT issue_books.id, users.id as user_id, users.email, users.pno, library_books.id as book_id, library_books.title, issue_date, return_date, issue_books.status 
FROM issue_books
INNER JOIN users ON issue_books.user_id = users.id
INNER JOIN library_books ON issue_books.book_id = library_books.id
WHERE issue_books.status = 'Issued'
AND users.id = $userId"; // Concatenate the user ID into the SQL query
$result = $conn->query($sql);

// Check if the query was executed successfully
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Prepare data array
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Convert data array to JSON
$data_json = json_encode($data);

// Close database connection
$conn->close();
?>
<div class="card mt-5">
    <div class="card-header">
        Issued Books
    </div>
    <div class="card-body">
        <table id="issuedBooksTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <!-- <th>Fine</th> -->
                </tr>
            </thead>
            <tbody>
                <!-- DataTable rows will be populated dynamically -->
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/links.php'; ?>
<script>
$(document).ready(function() {
    var table = $('#issuedBooksTable').DataTable({
        data: <?php echo $data_json; ?>,
        columns: [
            { data: 'email' },
            { data: 'book_id' },
            { data: 'title' },
            { data: 'issue_date' },
            { data: 'return_date' }
        ]
    });
});
</script>
<?php include 'inc/foot.php'; ?>