<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
   $headerContent = "Update Books";
    include 'inc/head.php';
?>  
<div class="m-2">
    <!-- DataTable -->
    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Languages</th>
                <!-- <th>Description</th> -->
                <th>Quantity</th>
                <!-- <th>Price</th> -->
                <th>Status</th>
                <th>Conditions</th>
                <th>Action</th> <!-- New column for action buttons -->
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be populated dynamically -->
        </tbody>
    </table>
</div>

<!-- Update form modal -->
<div class="modal" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Update form will be inserted here -->
                <form id="updateForm">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" class="form-control" id="author" name="author">
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher:</label>
                        <input type="text" class="form-control" id="publisher" name="publisher">
                    </div>
                    <div class="form-group">
                        <label for="languages">Languages:</label>
                        <input type="text" class="form-control" id="languages" name="languages">
                    </div>
                    <!-- <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div> -->
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity">
                    </div>
                    <!-- <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="text" class="form-control" id="status" name="status">
                    </div> -->
                    <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Available</option>
                                    <option value="0">Unavailable</option>
                                </select>
                            </div>
                    <div class="form-group">
                        <label>Condition:</label>
                        <select class="form-control" id="conditions" name="conditions" required>
                            <option value="New">New</option>
                            <option value="Good">Good</option>
                            <option value="Fair">Fair</option>
                            <option value="Poor">Poor</option>
                        </select>
                    </div> 
                    <!-- <div class="form-group">
                        <label for="conditions">Conditions:</label>
                        <input type="text" class="form-control" id="conditions" name="conditions">
                    </div> -->
                    <input type="hidden" id="bookId" name="id">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/links.php'; ?>
<script>
    $(document).ready(function() {
    // DataTable initialization
    var table = $('#dataTable').DataTable({
        ajax: {
            url: 'update_book_fetch_library_books.php', // PHP script to fetch data
            dataSrc: '' // Data source (empty to allow direct use of array of objects)
        },
        columns: [
            { data: 'id' },
            { data: 'title' },
            { data: 'author' },
            { data: 'publisher' },
            { data: 'languages' },
            // { data: 'description' },
            { data: 'quantity' },
            // { data: 'price' },
            { data: 'status' },
            { data: 'conditions' },
            { // New column for action buttons
                data: null,
                render: function(data, type, row) {
                    return '<button type="button" class="btn btn-primary btn-sm updateBtn">Update</button>';
                }
            }
        ]
    });

    // Update form submission handling
    $('#updateForm').submit(function(event) {
        event.preventDefault(); // Prevent form submission
        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            url: 'up_update_book.php', // PHP script to handle update
            method: 'POST',
            data: formData,
            success: function(response) {
                // Reload DataTable after successful update
                table.ajax.reload();
                // Hide modal
                $('#updateModal').modal('hide');
            },
            error: function(xhr, status, error) {
                // Show error message
                alert('Error: ' + xhr.responseText);
            }
        });
    });

    // Handle click event for update buttons
    $('#dataTable tbody').on('click', '.updateBtn', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#bookId').val(data.id);
        $('#title').val(data.title);
        $('#author').val(data.author);
        $('#publisher').val(data.publisher);
        $('#languages').val(data.languages);
        $('#description').val(data.description);
        $('#quantity').val(data.quantity);
        $('#price').val(data.price);
        $('#status').val(data.status);
        $('#conditions').val(data.conditions);
        $('#updateModal').modal('show');
    });

});

</script>
<?php include 'inc/foot.php'; ?>
