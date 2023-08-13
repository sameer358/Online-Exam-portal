<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    /* ... (existing styles) ... */

    /* Additional styles for password hint */
    .password-hint {
      font-size: 12px;
      color: #999;
      margin-top: 5px;
    }
  /* Reset some default styles */
  body, h3, form {
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }

    /* Container for the Holy Grail layout */
    .container {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Header styles */
    header {
  background-color: #7B7D7D; /* Transparent blue */
  padding: 5px; /* Further decrease the padding */
  color: #fff;
  text-align: center;
  border: 1px solid transparent;
  display: flex;
  justify-content: space-between;
  align-items: center;
  /* Add a gradient background */
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
    }

    /* Footer styles */
    footer {
  background-color: #7B7D7D; /* Transparent blue */
  padding: 5px; /* Further decrease the padding */
  color: #fff;
  text-align: center;
  grid-column: 1 / -1;
  /* Add a gradient background */
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
}

    /* Main content area */
    .main-content {
      flex: 1;
      display: flex;
      justify-content: space-between;
      padding: 20px;
    }

    /* Left sidebar styles */
    .left-sidebar {
      flex: 0 0 200px;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Right sidebar styles */
    .right-sidebar {
      flex: 0 0 200px;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Form styles */
    form {
      flex: 1;
      max-width: 300px;
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
      <p>Back to <a href="index.php">Main Page</a></p>
      &copy; <?php echo date('Y'); ?> Online Exam. All rights reserved.
    </footer>
  </div>
</body>
</html>