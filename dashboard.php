<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
   *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    /* Body styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Header styles */
    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #c7c7c7; /* Updated to a light color */
      color: #333; /* Updated to a darker color */
      padding: 20px;
    }

    .header h1 {
      margin: 0;
    }

    /* Navigation bar styles */
    .nav {
      display: flex;
      justify-content: center;
      background-color: #666;
      padding: 10px;
    }

    .nav a {
      display: inline-block;
      margin: 0 10px;
      padding: 10px 15px;
      background-color: #666;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .nav a:hover {
      background-color: #444;
    }

    /* Main content area styles */
    .main {
      flex: 1;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      padding: 20px;
    }

    .container {
      flex: 0 0 calc(30% - 20px);
      margin-bottom: 20px;
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Exam link styles */
    .container a {
      display: block;
      text-align: center;
      padding: 10px;
      background-color: #007BFF;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .container a:hover {
      background-color: #0056b3;
    }

    /* Sidebar styles */
    .sidebar {
      flex: 0 0 30%;
      background-color: #ddd;
      padding: 10px;
      border-radius: 5px;
      margin-top: 20px;
    }

    /* Footer styles */
    .footer {
      padding: 10px;
      text-align: center;
      background-color: #c7c7c7; /* Updated to a light color */
      color: #333; /* Updated to a darker color */
      margin-top: auto;
    }

    /* Logout button styles */
    .logout-btn {
      padding: 5px 10px;
      background-color: #444;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #666;
    }
  </style>
</head>
<body>
<div class="header">
    <h1>Welcome to the Dashboard!</h1>
    <a class="logout-btn" href="logout.php">Logout</a>
  </div>

  <div class="nav">
    <a href="dashboard.php">Home</a>
    <a href="contact.php">Contact Us</a>
    <a href="about.php">About Us</a>
  </div>

  <div class="main">
    <?php
    // Database connection configuration (replace with your own credentials)
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'quiz';

    // Create a database connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check if the connection is successful
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    session_start();

    // Check if the username is set in the session
    if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit();
    }

    // Retrieve the username from the session
    $username = $_SESSION['username'];

    // Retrieve other user information from the database (you may need to adjust the column names)
    $sql_user_info = "SELECT * FROM users WHERE username = '$username'";
    $result_user_info = mysqli_query($conn, $sql_user_info);

    // Check if the query executed successfully
    if (!$result_user_info) {
      die("Error executing the SELECT query: " . mysqli_error($conn));
    }

    // Fetch user information from the database
    $user_info = mysqli_fetch_assoc($result_user_info);

    // Display the user information
    echo '
      <div class="container">
        <h2>User Information</h2>
        <p>Student Name: ' . ucfirst($user_info['username']) . '</p>
        <!-- Add more user information fields here if needed -->
      </div>
    ';

    echo '
      <div class="container">
        <h2>Exam</h2>
        <p><a href="exam.php">Take Exam</a></p>
      </div>
    ';

    echo '
      <div class="container">
        <h2>See Result </h2>
        <p><a href="submit_exam.php">Click me</a></p>
      </div>
    ';
    ?>
  </div>

  <div class="sidebar">
    <!-- Sidebar content can be added here if needed -->
  </div>

  <div class="footer">
    <p>&copy; <?php echo date("Y"); ?>  Online Exam. All rights reserved.</p>
  </div>
</body>
</html>
