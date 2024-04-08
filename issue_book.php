<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "Issue Books Form";
    include 'inc/head.php';
?>
    <div class="m-2">
        <form method="post" id="book_i" action="process_issue_books.php">
            <div class="form-group">
                <label for="user_id">User ID</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="user_id" name="user_id">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="fetch_user_info">Fetch User Info</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" readonly>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" readonly>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="pno">Phone Number</label>
                        <input type="text" class="form-control" id="pno" name="pno" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="pno">Book ID</label>
                        <input type="text" class="form-control" id="book_id" name="book_id">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="pno">Issue Date</label>
                        <input type="text" class="form-control" value="<?php echo date('Y/m/d');?>" readonly>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="pno">Return Date</label>
                        <input type="text" class="form-control" value="<?php $currentDate = date('Y/m/d'); echo date('Y/m/d', strtotime($currentDate . ' + 7 days'));?>" readonly>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
    <?php include 'inc/links.php'; ?>
    <script>
    $(document).ready(function() {
        $('#fetch_user_info').click(function() {
            var user_id = $('#user_id').val();
            $.ajax({
                url: 'issue_book_fetch_user_info.php',
                type: 'POST',
                data: { user_id: user_id },
                success: function(response) {
                    var data = JSON.parse(response);
                    if(data.error) {
                        alert(data.error);
                    } else {
                        $('#uname').val(data.fname);
                        $('#email').val(data.email);
                        $('#pno').val(data.pno);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while fetching user info: ' + error);
                    console.log(xhr.responseText); // Log detailed error response to console
                }
            });
        });

        $('#book_name').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'issue_book_fetch_books.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while fetching book names: ' + error);
                        console.log(xhr.responseText); // Log detailed error response to console
                    }
                });
            },
            select: function(event, ui) {
                var selectedBookName = ui.item.value;
                $.ajax({
                    url: 'issue_book_fetch_book_info.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        book_name: selectedBookName
                    },
                    success: function(data) {
                        $('#book_id').val(data.id); // Populate book ID input box
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while fetching book info: ' + error);
                        console.log(xhr.responseText); // Log detailed error response to console
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Handle form submission
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();

            // Send AJAX request to process_issue_books.php
            $.ajax({
                url: 'issue_book_process_issue_books.php',
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    // Handle success response
                    if (response.success) {
                        alert('Book issued successfully!');
                        location.reload();
                        // $('#book_i :input').val('');
                    } else {
                        alert('Failed to issue the book. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('An error occurred while processing the request: ' + error);
                    console.log(xhr.responseText); // Log detailed error response to console
                }
            });
        });
    });
</script>
<?php include 'inc/foot.php'; ?>
