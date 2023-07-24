<?php
session_start();

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the username and password match a record in the database
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Successful login, set the username in the session
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit();
  } else {
    // Invalid login credentials
    $error = "Invalid username or password.";
  }
}

// Close the database connection
$conn->close();
?>
<?php if (isset($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
  <?php } ?>

<!DOCTYPE html>
<html>
<head>
  <title>eExam Portal</title>
  <style>
    /* CSS styles for header and footer */
    header {
      background-color: #7B7D7D; /* Transparent blue */
      padding: 10px;
      color: #fff;
      text-align: center;
      border: 1px solid transparent;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header a {
      color: #fff;
      text-decoration: none;
      margin: 0 10px;
      font-size: 18px;
    }

    header a:hover {
      text-decoration: underline;
    }

    .menu {
      display: flex;
      align-items: center;
    }

    footer {
      background-color: #7B7D7D; /* Transparent blue */
      padding: 10px;
      color: #fff;
      text-align: center;
      grid-column: 1 / -1;
    }

    /* Additional CSS styles */
    body {
      font-family: Arial, sans-serif;
      background-color: transparent; /* Transparent background */
      margin: 0;
      padding: 0;
      display: grid;
      grid-template-columns: 1fr minmax(0, 600px) 1fr;
      grid-template-rows: auto 1fr auto;
      min-height: 100vh;
    }

    .container {
      max-width: 400px;
      background-color: rgba(255, 255, 255, 0.9); /* Transparent white */
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
      margin-bottom: 10px;
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

    /* Additional CSS styles for exam dashboard look */
    .dashboard {
      grid-column: 2 / 3;
      grid-row: 2 / 3;
      background-color: rgba(255, 255, 255, 0.9); /* Transparent white */
      border-radius: 5px;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .dashboard .container {
      flex-basis: 100%;
      margin-bottom: 20px;
    }

    .dashboard .container h2 {
      font-size: 24px;
      margin-bottom: 15px;
    }

    .dashboard .container form {
      margin-top: 20px;
    }

    .dashboard .container input[type="submit"] {
      font-size: 16px;
    }

    /* Style the "Login as Admin" link */
    .login-admin-link {
      float: right;
      color: #333;
      text-decoration: none;
      font-size: 16px;
    }

    .login-admin-link:hover {
      color: #4caf50;
    }

    /* Additional CSS styles for the "Login here" link */
    p.login-link {
      text-align: center;
      margin-top: 10px;
    }

    p.login-link a {
      color: #4caf50;
      text-decoration: none;
    }

    p.login-link a:hover {
      text-decoration: underline;
    }

    /* CSS Grid layout areas */
    header {
      grid-column: 1 / -1;
    }

    .benefits {
      grid-column: 1 / 2;
      background-color: rgba(255, 255, 255, 0.9); /* Transparent white */
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .benefits-content {
      padding: 20px;
    }

    .benefits-content p {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .dashboard {
      grid-column: 2 / 3;
      grid-row: 2 / 3;
    }

    footer {
      grid-column: 1 / -1;
    }
    .right-side {
  grid-column: 3 / 4; /* Place it on the 3rd grid column */
  grid-row: 2 / 3; /* Span 1 row */
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Rectangle styles for MCA and BCA links */
.right-side a {
  color: #333;
  text-decoration: none;
  display: block;
  margin-bottom: 10px;
  padding: 10px 20px;
  border: 2px solid #4caf50; /* Green border */
  border-radius: 5px;
}

.right-side a:hover {
  color: #4caf50;
  background-color: #f9f9f9; /* Light gray background on hover */
}


  </style>


</head>
<body>
<header>
  <h1>eExam Portal</h1>
  <div class="menu">
    <a href="#">Home</a>
    <a href="#">Contact Us</a>
    <a href="#">About Us</a>
  </div>
</header>
<!-- Right side section -->

<div class="right-side">
<h2>Knowledge Base Article</h2>
  <a href="#">Defensive Cyber Security Technologies</a>
  <a href="#">Artificial Intelligence and Machine Learning</a>
  <a href="#"> Internet of Things</a>
  <a href="#"> Big Data Analytics</a>
  <a href="#"> IT Project Management</a>
  <a href="#"> Python</a>
  <a href="#"> Php & MySQL</a>
  
</div>

<div class="benefits">
  <div class="benefits-content">
    <h2>Benefits of eExam Portal</h2>
    <p> Convenience: Take exams from anywhere with an internet connection.</p>
    <p> Time-Saving: No need to travel to a physical location for exams.</p>
    <p> Immediate Results: Get instant feedback on your performance.</p>
    <p> Environmentally Friendly: Reduce paper waste with digital exams.</p>
  </div>
</div>

<div class="dashboard">
  <div class="container">
    <h2>Login Here</h2>
    <form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Log in">
  </form>
  <p class="login-link">Back to <a href="index.php">Home Page</a></p>
  </div>
</div>

<footer>
  <p>Login as <a href="admin_login.php">Admin</a></p>
  &copy; 2023 Online Exam. All rights reserved.
</footer>
</body>
</html>
