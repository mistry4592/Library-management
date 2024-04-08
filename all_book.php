<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    $headerContent = "Library All Books";
    include 'inc/head.php';
?>  
    <div class="m-2">
        <div class="card">
            <!-- <div class="card-header">
                <h2 class="mb-0">Library Books</h2>
            </div> -->
            <div class="card-body">
                <table id="booksTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Languages</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Condition</th>
                            <th>Action</th> <!-- Added column for action button -->
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Book data will be dynamically populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'inc/links.php'; ?>
    <script>
        $(document).ready(function() {
    // Fetch books data using AJAX
    $.ajax({
        url: 'add_book_fetch_books.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Populate datatable with fetched data
            $('#booksTable').DataTable({
                data: response,
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'author' },
                    { data: 'publisher' },
                    { data: 'languages' },
                    { data: 'quantity' },
                    { data: 'status' },
                    { data: 'conditions' },
                    {
                        // Add a button in each row to view cover page
                        data: null,
                        render: function(data, type, row) {
                            return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#coverPageModal' + row.id + '">View Cover</button>';
                        }
                    }
                    // Add more columns as needed
                ]
            });

            // Add modals for each book to display cover page
            response.forEach(function(book) {
                var modal = '<div class="modal fade" id="coverPageModal' + book.id + '" tabindex="-1" role="dialog" aria-labelledby="coverPageModalLabel' + book.id + '" aria-hidden="true">' +
                                '<div class="modal-dialog" role="document">' +
                                    '<div class="modal-content">' +
                                        '<div class="modal-header">' +
                                            '<h5 class="modal-title" id="coverPageModalLabel' + book.id + '">Cover Page</h5>' +
                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                            '</button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<img src="' + book.cover_image + '" class="img-fluid" alt="Cover Page">' + // Adjusted path here
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';
                $('body').append(modal);
            });
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(error);
            alert('Error occurred while fetching books. Please try again later.');
        }
    });
});

    </script>

<?php include 'inc/foot.php'; ?>
