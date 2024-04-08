<?php
// Include the database connection
include 'db.php';

// Initialize variables to store user data
$id = $fname = $lname = $email = $pno = $addhar = '';

// Fetch user data from the database
$sql = "SELECT `id`, `fname`, `lname`, `email`, `pno`, `addhar` FROM `users` WHERE 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch data from the result set
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $pno = $row['pno'];
    $addhar = $row['addhar'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 30px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control[readonly] {
            background-color: #f8f9fa;
            border: none;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">User Profile</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstName">User ID</label>
                        <input type="text" class="form-control" id="firstName" value="<?php echo $id; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="<?php echo $fname; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="<?php echo $lname; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" value="<?php echo $pno; ?>" readonly>
                    </div>
                    <!-- <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" rows="3" readonly><?php echo $address; ?></textarea>
                    </div> -->
                    <div class="form-group">
                        <label for="aadhar">Aadhar Number</label>
                        <input type="text" class="form-control" id="aadhar" value="<?php echo $addhar; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
