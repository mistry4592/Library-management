<?php
    // echo $headerContent = "Admin Dashboard";
    // include 'inc/head.php';
?>
<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "Admin Dashboard";
    include 'inc/head.php';
?>
<div class="page-content">
    <div class="analytics">
        <div class="card">
            <div class="card-head">
                <?php
                    // Include the db.php file
                    include('db.php');

                    // Check if the database connection is successful
                    if ($conn) {
                        // SQL query to count the total number of users
                        $sql = "SELECT COUNT(*) AS totalUsers FROM users";
                        $result = mysqli_query($conn, $sql);

                        // Check if the query was successful
                        if ($result) {
                            // Fetch the result as an associative array
                            $row = mysqli_fetch_assoc($result);
                            // Get the total number of users
                            $totalUsers = $row['totalUsers'];
                        } else {
                            // If the query fails, set total users to 0 or display an error message
                            $totalUsers = 0;
                            // Alternatively, you can handle the error here
                        }

                        // Close the database connection
                        mysqli_close($conn);
                    } else {
                        // If the database connection fails, handle the error here
                        echo "Failed to connect to the database.";
                    }
                    ?>
                <h2>
                    <?php echo $totalUsers; ?>
                </h2>
                <span class="las la-user-friends"></span>
            </div>
            <h4>Total User</h4>
        </div>
        <div class="card">
            <div class="card-head">
                <?php
                    // Include the db.php file
                    include('db.php');

                    // Check if the database connection is successful
                    if ($conn) {
                        // SQL query to count the total number of books
                        $sql = "SELECT COUNT(*) AS totalBooks FROM library_books";
                        $result = mysqli_query($conn, $sql);

                        // Check if the query was successful
                        if ($result) {
                            // Fetch the result as an associative array
                            $row = mysqli_fetch_assoc($result);
                            // Get the total number of books
                            $totalBooks = $row['totalBooks'];
                            // Output the total number of books
                            // echo "Total Books: " . $totalBooks;
                        } else {
                            // If the query fails
                            echo "Error: " . mysqli_error($conn);
                        }

                        // Close the database connection
                        mysqli_close($conn);
                    } else {
                        // If the database connection fails
                        echo "Failed to connect to the database.";
                    }
                    ?>
                <h2>
                    <?php echo $totalBooks; ?>
                </h2>
                <span class="las la-eye"></span>
            </div>
            <div class="card-progress">
                <h4>Total Books</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-head">
                <h2>25</h2>
                <span class="las la-shopping-cart"></span>
            </div>
            <div class="card-progress">
                <h4>Issue Books</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-head">
                <h2>25</h2>
                <span class="las la-envelope"></span>
            </div>
            <div class="card-progress">
                <h4>Pending Books</h4>
            </div>
        </div>
    </div>
</div>
<?php
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
                <th>User ID</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Book ID</th>
                <th>Title</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <!-- <th>Status</th> -->
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
    // Initialize DataTable with Bootstrap styling
    var table = $('#issuedBooksTable').DataTable({
        data: <?php echo $data_json; ?>,
        columns: [
            { data: 'user_id' },
            { data: 'email' },
            { data: 'pno' },
            { data: 'book_id' },
            { data: 'title' },
            { data: 'issue_date' },
            { data: 'return_date' },
            // { data: 'status' },
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
        var id = $(this).data('id');
        var button = $(this);

        // Display a confirmation dialog
        if (confirm("Are you sure you want to mark this book as returned?")) {
            // If user confirms, send AJAX request to return_book.php
            $.ajax({
                url: 're_return_book.php',
                type: 'POST',
                data: { id: id },
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