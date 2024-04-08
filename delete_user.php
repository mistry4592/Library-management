<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "Delete User Info";
    include 'inc/head.php';
?>
<div class="m-2">
    <!-- DataTable -->
    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone Number</th>
                <th>Status</th>
                <th>Action</th> <!-- New column for action buttons -->
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be populated dynamically -->
        </tbody>
    </table>
</div>

<?php include 'inc/links.php'; ?>
<script>
    $(document).ready(function() {
        // DataTable initialization
        var table = $('#dataTable').DataTable({
            ajax: {
                url: 'delete_user_fetch_users.php', // PHP script to fetch data
                dataSrc: '' // Data source (empty to allow direct use of array of objects)
            },
            columns: [
                { data: 'id' },
                { data: 'fname' },
                { data: 'lname' },
                { data: 'email' },
                { data: 'role' },
                { data: 'pno' },
                { data: 'status' },
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
            if (confirm('Are you sure you want to delete user with ID ' + data.id + '?')) {
                $.ajax({
                    url: 'delete_user_code.php', // PHP script to handle delete
                    method: 'POST',
                    data: { id: data.id },
                    success: function(response) {
                        // Reload DataTable after successful deletion
                        table.ajax.reload();
                        // Show success message
                        alert('User deleted successfully.');
                    },
                    error: function(xhr, status, error) {
                        // Show error error message
                        alert('Error: ' + xhr.responseText);
                    }
                });
            }
        });
    });
</script>
<?php include 'inc/foot.php'; ?>
