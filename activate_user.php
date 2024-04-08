<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
   $headerContent = "Activate/Deactivate Users";
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
                <!-- <th>Action</th>-->
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
                url: 'activate_user_fetch_users.php', // PHP script to fetch data
                dataSrc: '' // Data source (empty to allow direct use of array of objects)
            },
            columns: [
                { data: 'id' },
                { data: 'fname' },
                { data: 'lname' },
                { data: 'email' },
                { data: 'role' },
                { data: 'pno' },
                { 
                    data: 'status',
                    render: function(data, type, row) {
                        if(data == 0) {
                            return '<button type="button" class="btn btn-success btn-sm updateStatusBtn" data-id="' + row.id + '" data-action="deactivate">Activate</button>';
                        } else {
                            return '<button type="button" class="btn btn-danger btn-sm updateStatusBtn" data-id="' + row.id + '" data-action="activate">Deactivate</button>';
                        }
                    }
                },
            ]
        });

        // Update status handling
        $('#dataTable tbody').on('click', '.updateStatusBtn', function() {
            var userId = $(this).data('id');
            var action = $(this).data('action');
            $.ajax({
                url: 'activate_user_update_user_status.php',
                method: 'POST',
                data: { id: userId, action: action },
                success: function(response) {
                    // Reload DataTable after successful update
                    table.ajax.reload();
                    // Show success message
                    alert(response);
                },
                error: function(xhr, status, error) {
                    // Show error message
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>

<?php include 'inc/foot.php'; ?>
