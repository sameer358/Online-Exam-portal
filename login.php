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
  /* Base styles */
  body {
    font-family: Arial, sans-serif;
    background-color: transparent;
    margin: 0;
    padding: 0;
    display: grid;
    grid-template-columns: 1fr minmax(0, 600px) 1fr;
    grid-template-rows: auto 1fr auto;
    min-height: 100vh;
  }

  header {
    background-color: #7b7d7d;
    /* Transparent blue */
    padding: 5px;
    color: #fff;
    text-align: center;
    border: 1px solid transparent;
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* Add a gradient background */
    background-image: linear-gradient(to right, #42557b, #7b7d7d);
    grid-column: 1 / -1;
  }

  header a {
    color: #fff;
    text-decoration: none;
    margin: 0 5px;
    /* Further decrease the margin */
    font-size: 14px;
    /* Further decrease the font size */
  }

  footer {
    background-color: #7b7d7d;
    /* Transparent blue */
    padding: 5px;
    color: #fff;
    text-align: center;
    grid-column: 1 / -1;
    /* Add a gradient background */
    background-image: linear-gradient(to right, #42557b, #7b7d7d);
  }

  /* Container styles */
  .container {
    max-width: 400px;
    background-color: rgba(255, 255, 255, 0.9);
    /* Transparent white */
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Heading styles */
  h2 {
    color: #333;
    margin-bottom: 10px;
  }

  /* Form input styles */
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

  /* Dashboard styles */
  .dashboard {
    grid-column: 2 / 3;
    grid-row: 2 / 3;
    background-color: rgba(255, 255, 255, 0.9);
    /* Transparent white */
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

  /* Login link styles */
  .login-admin-link {
    float: right;
    color: #333;
    text-decoration: none;
    font-size: 16px;
  }

  .login-admin-link:hover {
    color: #4caf50;
  }

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

  /* Benefits styles */
  .benefits {
    grid-column: 1 / 2;
    background-color: rgba(255, 255, 255, 0.9);
    /* Transparent white */
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

  /* Right-side styles */
  .right-side {
    grid-column: 3 / 4;
    /* Place it on the 3rd grid column */
    grid-row: 2 / 3;
    /* Span 1 row */
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
    border: 2px solid #4caf50;
    /* Green border */
    border-radius: 5px;
  }

  .right-side a:hover {
    color: #4caf50;
    background-color: #f9f9f9;
    /* Light gray background on hover */
  }
  .error {
  color: red; /* Set the text color to red for error messages */
  font-size: 14px; /* Optionally adjust the font size */
  margin-top: 10px; /* Optionally add some top margin to separate from the form */
}
</style>
</head>
<body>
<header>
  <h1>eExam Portal</h1>
  <div class="menu">
    <a href="admin_login.php">Login as Admin</a>
    <a href="#">About Us</a>
    
  </div>
</header>
<!-- Right side section -->

<div class="right-side">
<h2>Knowledge Base Article</h2>
<a href="https://enhanceofit.blogspot.com/" target="_blank">Defensive Cyber Security Technologies</a>
  <a href="https://enhanceofit.blogspot.com/" target="_blank">Artificial Intelligence and Machine Learning</a>
  <a href="https://enhanceofit.blogspot.com/" target="_blank"> Internet of Things</a>
  <a href="https://enhanceofit.blogspot.com/" target="_blank"> Big Data Analytics</a>
  <a href="https://enhanceofit.blogspot.com/" target="_blank">IT Project Management</a>
  <a href="https://enhanceofit.blogspot.com/" target="_blank"> Python</a>
  <a href="https://enhanceofit.blogspot.com/" target="_blank"> Php & MySQL</a>
  
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
    <?php if (isset($error)) { ?>
      <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Log in">
  </form>
  <p class="login-link">Back to <a href="index.php">Home Page</a></p>
  </div>
</div>

<footer>
  &copy; 2023 Online Exam. All rights reserved.
</footer>
</body>
</html>
