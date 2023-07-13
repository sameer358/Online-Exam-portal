<?php
// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'quiz';

// Check if the user ID parameter is provided
if (isset($_GET['id'])) {
  // Get the user ID from the URL parameter
  $userId = $_GET['id'];

  // Connect to the MySQL database
  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the SQL query to delete the user
  $sql = "DELETE FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();

  // Check if the deletion was successful
  if ($stmt->affected_rows > 0) {
    // User deleted successfully
    echo "User deleted successfully.";
  } else {
    // User deletion failed
    echo "Failed to delete user.";
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
} else {
  // No user ID provided, redirect back to the user list page
  header("Location: user_list.php");
  exit();
}
?>
