<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
 /* Global styles */
*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f1f1f1;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  margin: 0;
  line-height: 1.6;
}

/* Header styles */
.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
  padding: 10px 20px;
  color: #fff;
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
footer {
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
  padding: 5px;
  color: #fff;
  text-align: center;
  grid-column: 1 / -1;
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
.nav i {
      margin-right: 5px; /* Adjust this value to change the space between icon and text */
    }
  </style>
</head>
<body>

<div class="header">
    <h1>Welcome to the Dashboard!</h1>
    <a class="logout-btn" href="logout.php">Logout</a>

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

    // Retrieve other user information from the database
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
        <p>User ID: ' . $user_info['id'] . '</p>
        <p>User Name: ' . ucfirst($user_info['username']) . '</p>
        <p>Full Name: ' . ucfirst($user_info['full_name']) . '</p>
        <p>Email: ' . $user_info['email'] . '</p>
        <p><a href="user_change_password.php">Change User Password</a></p>
    </div>
    ';

    echo '
    <div class="container">
        <h2>CS Exam</h2>
        <p><a href="exam.php">Take Exam</a></p>
    </div>
    ';

    echo '
    <div class="container">
        <h2>Previous Result</h2>
        <p><a href="exam_result.php?username=' . $username . '">Check Previous Result</a></p>
    </div>
    ';
?>

    
  </div>
  <div class="footer">
    <p>&copy; <?php echo date("Y"); ?>  Online Exam. All rights reserved.</p>
  </div>
</body>
</html>
