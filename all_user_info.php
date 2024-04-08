<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "All User";
    include 'inc/head.php';
?>
    <div class="m-2">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <table id="userTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Aadhar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        
<?php include 'inc/links.php'; ?>
        <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#userTable').DataTable({
                "ajax": {
                    "url": "fetch_users.php",
                    "dataSrc": "data"
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "role" },
                    { "data": "phone" },
                    { "data": "aadhar" },
                    { "data": "status" }
                ]
            });
        });
        </script>

<?php include 'inc/foot.php'; ?>