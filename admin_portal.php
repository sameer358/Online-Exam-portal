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

// Check if the user is logged in as an admin
// You may have a login system in place to authenticate admin users

// Query to retrieve questions from the database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

// Display questions in the admin portal
if ($result->num_rows > 0) {
  echo '<h1>Admin Portal</h1>';
  echo '<h2>Questions</h2>';
  echo '<ul>';
  while ($row = $result->fetch_assoc()) {
    echo '<li>'.$row['question'].'</li>';
  }
  echo '</ul>';
} else {
  echo 'No questions found.';
}

// Close the database connection
$conn->close();
?>
