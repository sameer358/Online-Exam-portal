<?php
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'quiz';

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$username = $_POST['username'];
$new_password = $_POST['new_password'];

// Update the user's password in the database
$sql = "UPDATE users SET password = '$new_password' WHERE username = '$username'";

if ($conn->query($sql) === TRUE) {
    echo "Password changed successfully!";
} else {
    echo "Error updating password: " . $conn->error;
}

$conn->close();
?>

<html>
    <body>
<footer>
    <p>Back to <a href="admin_dashboard.php">Admin Dashboard</a></p>
    &copy; 2023 Online Exam. All rights reserved.
  </footer>
</body>
</html>
