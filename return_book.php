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
        INNER JOIN library_books ON issue_books.book_id = library_books.id
        WHERE issue_books.status = 'Issued'";
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
                    <th>Fine</th>
                    <th>Action</th>
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
            render: function(data, type, row) {
                // Calculate extra days overdue
                var returnDate = new Date(data);
                var currentDate = new Date();
                var daysOverdue = Math.floor((currentDate - returnDate) / (1000 * 60 * 60 * 24));

                // Return date with extra days overdue if applicable
                return (daysOverdue > 0) ? data + ' (' + daysOverdue + ' days overdue)' : data;
            }
        },
        {
            data: null,
            render: function(data, type, row) {
                // Calculate fine per day (assuming 10 Rs per day)
                var finePerDay = 10;
                
                // Calculate extra days overdue
                var returnDate = new Date(row.return_date);
                var currentDate = new Date();
                var daysOverdue = Math.floor((currentDate - returnDate) / (1000 * 60 * 60 * 24));
                
                // Calculate total fine
                var totalFine = (daysOverdue > 0) ? daysOverdue * finePerDay : 0;
                
                // Return total fine with currency symbol
                return 'Rs. ' + totalFine;
            }
        },
        {
            // Add "Return" button for each row
            data: null,
            render: function(data, type, row) {
                return '<button class="btn btn-primary returnBtn" data-id="' + row.id + '">Return</button>';
            }
        }
    ]
});



    // Handle click event of "Return" button
    $('#issuedBooksTable tbody').on('click', 'button.returnBtn', function() {
        var button = $(this);
        var data = table.row(button.parents('tr')).data(); // Retrieve the data of the clicked row
        var id = data.id; // Issue ID
        var bookId = data.book_id; // Book ID

        // Display a confirmation dialog
        if (confirm("Are you sure you want to mark this book as returned?")) {
            // If user confirms, send AJAX request to return_book.php
            $.ajax({
                url: 're_return_book.php',
                type: 'POST',
                data: { id: id, bookId: bookId }, // Send both issue ID and book ID
                success: function(response) {
                    // Remove the row from the DataTable
                    table.row(button.parents('tr')).remove().draw();
                    // Show return success alert
                    alert('Book returned successfully!');
                    // Reload the page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('Error returning book: ' + error);
                }
            });
        }
    });
});

    </script>
<?php include 'inc/foot.php'; ?>
