<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "Return Book";
    include 'inc/head.php';
?>
<?php
// Include the database connection
include 'db.php';

// Fetch only "Issued" books from the database
$sql = "SELECT issue_books.id, users.id as user_id, users.email, users.pno, library_books.id as book_id, library_books.title, issue_date, return_date, issue_books.status FROM issue_books
        INNER JOIN users ON issue_books.user_id = users.id
        INNER JOIN library_books ON issue_books.book_id = library_books.id";

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
<div class="m-2">
    <table id="issuedBooksTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Book ID</th>
                <th>Title</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <!-- <th>Fine</th> -->
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- DataTable rows will be populated dynamically -->
        </tbody>
    </table>
</div>
<?php include 'inc/links.php'; ?>
<script>
$(document).ready(function() {
    var table = $('#issuedBooksTable').DataTable({
        data: <?php echo $data_json; ?>,
        columns: [
            { data: 'id' },
            { data: 'user_id' },
            { data: 'email' },
            { data: 'pno' },
            { data: 'book_id' },
            { data: 'title' },
            { data: 'issue_date' },
            {
                data: 'return_date',
            },
            { data: 'status' }
        ]
    });


});
</script>
<?php include 'inc/foot.php'; ?>