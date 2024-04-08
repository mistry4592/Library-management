<?php
    session_start();
    $headerContent = "User Profile";
    include 'inc/user_head.php';
?>
<div class="container">
    <form id="profileForm">
        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" readonly>
        </div>
        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" readonly>
        </div>
        <div class="form-group">
            <label for="pno">Phone Number:</label>
            <input type="text" class="form-control" id="pno" name="pno" readonly>
        </div>
        <!-- Add more input fields for additional user data if needed -->
    </form>
</div>
<?php include 'inc/links.php'; ?>
<script type="text/javascript">
$(document).ready(function() {
    // Function to fetch user profile data via AJAX
    function fetchUserProfile() {
        $.ajax({
            url: 'profile_fetch_user.php', // Path to the PHP file handling profile requests
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                // Check if the response contains user data
                if (response.hasOwnProperty('error')) {
                    // Display error message if user data retrieval failed
                    alert('Error: ' + response.error);
                } else {
                    // Update the input fields with user data
                    $('#fname').val(response.fname);
                    $('#lname').val(response.lname);
                    $('#email').val(response.email);
                    $('#pno').val(response.pno);
                    // You may update additional input fields here
                }
            },
            error: function(xhr, status, error) {
                // Display error message if AJAX request fails
                alert('Error fetching user profile: ' + error);
            }
        });
    }

    // Call the fetchUserProfile function when the page loads
    fetchUserProfile();
});

</script>


<?php include 'inc/foot.php'; ?>