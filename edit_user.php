<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "Edit User Info";
    include 'inc/head.php';
?>
<div class="m-2">
    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone Number</th>
                <th>Aadhar</th>
                <th>Status</th>
                <th>Action</th> <!-- New column for action buttons -->
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be populated dynamically -->
        </tbody>
    </table>
</div>

<!-- Edit user modal -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="editFname">First Name:</label>
                        <input type="text" class="form-control" id="editFname" name="fname">
                    </div>
                    <div class="form-group">
                        <label for="editLname">Last Name:</label>
                        <input type="text" class="form-control" id="editLname" name="lname">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="editRole">Role:</label>
                        <input type="text" class="form-control" id="editRole" name="role">
                    </div>
                    <div class="form-group">
                        <label for="editPno">Phone Number:</label>
                        <input type="text" class="form-control" id="editPno" name="pno">
                    </div>
                    <div class="form-group">
                        <label for="editAddhar">Aadhar:</label>
                        <input type="text" class="form-control" id="editAddhar" name="addhar">
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status:</label>
                        <input type="text" class="form-control" id="editStatus" name="status">
                    </div>
                    <input type="hidden" id="editUserId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="editSubmit">Save Changes</button>
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
                url: 'edit_user_fetch_users.php', // PHP script to fetch data
                dataSrc: '' // Data source (empty to allow direct use of array of objects)
            },
            columns: [
                { data: 'id' },
                { data: 'fname' },
                { data: 'lname' },
                { data: 'email' },
                { data: 'role' },
                { data: 'pno' },
                { data: 'addhar' },
                { data: 'status' },
                               { // New column for action buttons
                    data: null,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-primary btn-sm editBtn">Edit</button>';
                    }
                }
            ]
        });

        // Edit button click handling
        $('#dataTable tbody').on('click', '.editBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            // Fill the modal form fields with user data
            $('#editUserId').val(data.id);
            $('#editFname').val(data.fname);
            $('#editLname').val(data.lname);
            $('#editEmail').val(data.email);
            $('#editRole').val(data.role);
            $('#editPno').val(data.pno);
            $('#editAddhar').val(data.addhar);
            $('#editStatus').val(data.status);
            // Show the edit modal
            $('#editModal').modal('show');
        });

        // Edit form submission handling
        $('#editSubmit').click(function() {
            $.ajax({
                url: 'edit_user_update_user.php', // PHP script to handle update
                method: 'POST',
                data: $('#editForm').serialize(),
                success: function(response) {
                    // Reload DataTable after successful update
                    table.ajax.reload();
                    // Hide modal
                    $('#editModal').modal('hide');
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
