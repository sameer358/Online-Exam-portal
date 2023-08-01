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

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Insert user into the database
  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  if ($conn->query($sql) === TRUE) {
    $message = "User account has been created successfully.";
    // Redirect to login.php after a delay of 1 seconds
    header("refresh:0; url=login.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close the database connection
$conn->close();
?>


<?php
  if (!empty($message)) {
    // Display the success message
    echo "<script>alert('$message');</script>";
  }
  ?>
</body>
</html>