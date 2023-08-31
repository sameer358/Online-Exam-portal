<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <header>
      <h3>Admin Login</h3>
    </header>

    <div class="main-content">
      <form action="admin_login.php" method="POST">
        <input type="text" name="admin_username" placeholder="Admin Username" required><br>
        <input type="password" name="admin_password" placeholder="Admin Password" ><br>
  
        <input type="submit" value="Login">
        <?php

// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'quiz';

// Connect to the MySQL database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the administrators table is empty
$sql = "SELECT COUNT(*) AS count FROM administrators";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$adminCount = $row['count'];

if ($adminCount === 0) {
  // If there are no administrator accounts, display an error message
  die("No administrator account found. Please create an administrator account.");
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $adminUsername = $_POST['admin_username'];
  $adminPassword = $_POST['admin_password'];

  // Check if the administrator credentials are valid
  $sql = "SELECT * FROM administrators WHERE admin_username = '$adminUsername' AND admin_password = '$adminPassword'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Valid administrator credentials, proceed to the admin dashboard
    header("Location: admin_dashboard.php");
    exit();
  } else {
    // Invalid administrator credentials
    $error = "Invalid administrator username or password.";
  }
}

// Close the database connection
$conn->close();
?>
      </form>

      <div class="right-sidebar">
        <!-- You can put any content here for the right sidebar -->
      </div>
    </div>

    <footer>
      <p>Back to <a href="index.php">Home</a></p>
     
    </footer>
  </div>
</body>
</html>