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
    $message = "User deleted successfully.";
  } else {
    // User deletion failed
    $message = "Failed to delete user.";
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

<!DOCTYPE html>
<html>
<head>
  <title>User Deletion</title>
  <style>
    /* ... (previously defined styles) ... */
    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #333;
    }
    p {
      color: #555;
      margin-bottom: 20px;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
    footer {
      text-align: center;
      margin-top: 20px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>User Deletion</h1>
    <p><?php echo $message; ?></p>
    <a class="btn" href="user_list.php">Back to User List</a>
  </div>
  <footer>
    &copy; <?php echo date("Y"); ?> Online Exam. All rights reserved.
  </footer>
</body>
</html>
