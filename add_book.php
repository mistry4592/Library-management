<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
   $headerContent = "Add New Book";
    include 'inc/head.php';
?>  
    <div class="m-2">
        <div class="card">
           <!--  <div class="card-header">
                <h2 class="mb-0">Add New Book</h2>
            </div> -->
            <div class="card-body">
                <form id="addBookForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title:</label>
                                <input type="text" class="form-control" name="add_book_title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Author:</label>
                                <input type="text" class="form-control" name="add_book_author_name" id="author_name">
                            </div>
                        </div>
                        <!-- Other input fields with add_book_ prefix -->
                        <!-- Publisher -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Publisher:</label>
                                <input type="text" class="form-control" name="add_book_publisher" required>
                            </div>
                        </div>
                        <!-- Language -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Language:</label>
                                <input type="text" class="form-control" name="add_book_language" required>
                            </div>
                        </div>
                        <!-- Quantity -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quantity:</label>
                                <input type="number" class="form-control" name="add_book_quantity" required>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control" name="add_book_status" required>
                                    <option value="1">Available</option>
                                    <option value="0">Unavailable</option>
                                </select>
                            </div>
                        </div>
                        <!-- Condition -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Condition:</label>
                                <select class="form-control" name="add_book_condition" required>
                                    <option value="New">New</option>
                                    <option value="Good">Good</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Poor">Poor</option>
                                </select>
                            </div>
                        </div>
                        <!-- Cover Image -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cover Image:</label>
                                <input type="file" class="form-control-file" name="add_book_cover_image" accept="image/*" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'inc/links.php'; ?>
    <!-- Custom JavaScript -->
    <script>
    $(document).ready(function() {
        $('#addBookForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize form data
            var formData = new FormData(this);

            // Submit form data using AJAX
            $.ajax({
                url: 'add_book_insert_book.php',
                type: 'POST',
                data: formData,
                dataType: 'json', // Change this according to your response type
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Example: Show success message to the user
                    alert('Book added successfully!');
                    // Reset the form
                    $('#addBookForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                    // Example: Show error message to the user
                    alert('Error occurred while adding book. Please try again later.');
                }
            });
        });
    });
    </script>

<?php include 'inc/foot.php'; ?>