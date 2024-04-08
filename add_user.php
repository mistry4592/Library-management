<?php
    include 'inc/admin_auth.php'; // Include the admin authentication file
    echo $headerContent = "Add User";
    include 'inc/head.php';
?>
    <div class="m-2">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">User Registration</h2>
            </div>
            <div class="card-body">
                <form id="addUserForm" enctype="multipart/form-data">
                    <div id="message"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" id="pass" name="pass" required>
                            </div>
                        </div>
                    </div>
                    <?php
                        include_once "db.php";

                        // Fetch all roles
                        $role_sql = "SELECT role_name FROM roles";
                        $role_result = $conn->query($role_sql);

                        $roles = array();
                        while ($row = $role_result->fetch_assoc()) {
                            $roles[] = $row['role_name'];
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editPno">Roles</label>
                                <select class="form-control"  name="role_name" id="role_name">
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pno">Phone Number</label>
                                <input type="text" class="form-control" id="pno" name="pno" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="addhar">Aadhar Number</label>
                                <input type="text" class="form-control" id="addhar" name="addhar" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <?php include 'inc/links.php'; ?>
<script>
    $(document).ready(function(){
        $('#addUserForm').submit(function(e){
            e.preventDefault(); // Prevent default form submission
            var formData = new FormData(this);

            $.ajax({
                url: 'code.php', // Sending the request to code.php
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#message').html('<div class="alert alert-success">' + response + '</div>');
                    $('#addUserForm')[0].reset(); // Reset the form after successful submission
                },
                error: function(xhr, status, error){
                    $('#message').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                }
            });
        });
    });
</script>

<?php include 'inc/foot.php'; ?>