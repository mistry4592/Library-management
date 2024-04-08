<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "Single User Info";
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
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be populated dynamically -->
        </tbody>
    </table>
</div>

<!-- User Info modal -->
<div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" aria-labelledby="userInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userInfoModalLabel">User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="userInfoContent">
                <!-- User info will be dynamically inserted here -->
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
                url: 'view_user_fetch_users.php', // PHP script to fetch data
                dataSrc: '' // Data source (empty to allow direct use of array of objects)
            },
            columns: [
                { data: 'id' },
                { data: 'fname' },
                { data: 'lname' },
                { data: 'email' },
                { data: 'role' },
                { data: 'pno' },
                { data: 'status' }
            ]
        });

        // Handle click event for table rows
        $('#dataTable tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            // Populate modal with user info
            $('#userInfoContent').html('<p><strong>ID:</strong> ' + data.id + '</p>' +
                                '<p><strong>First Name:</strong> ' + data.fname + '</p>' +
                                '<p><strong>Last Name:</strong> ' + data.lname + '</p>' +
                                '<p><strong>Email:</strong> ' + data.email + '</p>' +
                                '<p><strong>Role:</strong> ' + data.role + '</p>' +
                                '<p><strong>Phone Number:</strong> ' + data.pno + '</p>' +
                                '<p><strong>Status:</strong> ' + data.status + '</p>');
            // Show the modal
            $('#userInfoModal').modal('show');
        });
    });
</script>
<?php include 'inc/foot.php'; ?>
