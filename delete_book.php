<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    $headerContent = "Delete Books";
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

<!-- Delete confirmation modal -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this book?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
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
                url: 'delete_book_fetch_library_books.php', // PHP script to fetch data
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
                { data: 'price' },
                { data: 'status' },
                // { data: 'conditions' },
                { // New column for action buttons
                    data: null,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-danger btn-sm deleteBtn">Delete</button>';
                    }
                }
            ]
        });

        // Delete confirmation handling
        $('#dataTable tbody').on('click', '.deleteBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            if (confirm('Are you sure you want to delete book with ID ' + data.id + '?')) {
                $.ajax({
                    url: 'de_delete_book.php', // PHP script to handle delete
                    method: 'POST',
                    data: { id: data.id },
                    success: function(response) {
                        // Reload DataTable after successful deletion
                        table.ajax.reload();
                        // Show success alert
                        alert('Book with ID ' + data.id + ' deleted successfully.');
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        alert('Error: ' + xhr.responseText);
                    }
                });
            }
        });
    });
</script>
<?php include 'inc/foot.php'; ?>
