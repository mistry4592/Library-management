<?php
    session_start();
    // include 'inc/admin_auth.php'; // Include the admin authentication file
   $headerContent = "User Profile";
    include 'inc/head.php';
?>

<div class="container">
    <h2>User Profile</h2>
    <form id="profileForm">
        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" value="" required>
        </div>
        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" value="" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="" required readonly>
        </div>
        <div class="form-group">
            <label for="pno">Phone Number:</label>
            <input type="text" class="form-control" id="pno" name="pno" value="" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
<?php include 'inc/links.php'; ?>
<script>
$(document).ready(function() {
    // Fetch user information
    $.ajax({
        url: 'update_fetch_user_profile.php',
        method: 'GET',
        success: function(response) {
            var userInfo = JSON.parse(response);
            $('#fname').val(userInfo.fname);
            $('#lname').val(userInfo.lname);
            $('#email').val(userInfo.email);
            $('#pno').val(userInfo.pno);
        },
        error: function(xhr, status, error) {
            alert('Error fetching user information: ' + error);
        }
    });

    // Handle form submission
    $('#profileForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'update_user_profile_code.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response === 'success') {
                    alert('Profile updated successfully.');
                } else {
                    alert('Failed to update profile.');
                }
            },
            error: function(xhr, status, error) {
                alert('Error updating profile: ' + error);
            }
        });
    });
});
</script>
<?php include 'inc/foot.php'; ?>