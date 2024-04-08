<?php
    session_start();
    // include 'inc/admin_auth.php'; // Include the admin authentication file
    $headerContent = "User Profile";
    include 'inc/user_head.php';
?>

<form id="passwordChangeForm">
    <div class="form-group">
        <label for="currentPassword">Current Password:</label>
        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
    </div>
    <div class="form-group">
        <label for="newPassword">New Password:</label>
        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
    </div>
    <div class="form-group">
        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
    </div>
    <button type="submit" class="btn btn-primary">Change Password</button>
</form>

<?php include 'inc/links.php'; ?>

<script>
$(document).ready(function() {
    $('#passwordChangeForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Get form data
        var formData = {
            currentPassword: $('#currentPassword').val(),
            newPassword: $('#newPassword').val(),
            confirmPassword: $('#confirmPassword').val()
        };
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'change_pass_code.php', // PHP script to handle form submission
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    // Display success message
                    alert('Password changed successfully!');
                    // Clear form fields
                    $('#passwordChangeForm')[0].reset();
                } else {
                    // Display error message
                    alert('Error changing password: ' + response);
                }
            },
            error: function(xhr, status, error) {
                // Display error message
                alert('Error changing password: ' + error);
            }
        });
    });
});
</script>


<?php include 'inc/foot.php'; ?>
