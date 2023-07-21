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

// Check if the administrator account exists
$sql = "SELECT * FROM administrators";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
  // If the administrators table is empty, display an error message
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
    // Valid administrator credentials, proceed to the user list page
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

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 20px;
    }

    h3 {
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      max-width: 300px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <h3>Admin Login</h3>

  <form action="admin_login.php" method="POST">
    <input type="text" name="admin_username" placeholder="Admin Username" required><br>
    <input type="password" name="admin_password" placeholder="Admin Password" required><br>
    <input type="submit" value="Login">
  </form>

  <?php if (isset($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
  <?php } ?>
  <footer>
  <p>Back to <a href="index.php">Main Page</a></p>
    &copy; 2023 Online Exam. All rights reserved.
  </footer>
</body>
</html>
