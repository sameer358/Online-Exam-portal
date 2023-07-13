<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 20px;
    }

    h1 {
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
      margin-bottom: 10px;
    }

    p {
      color: #777;
    }
  </style>
</head>
<body>

<?php
session_start();

// Check if the username is set in the session
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Database connection configuration
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$database = 'quiz';

// Connect to the MySQL database
$conn = new mysqli($host, $dbUsername, $dbPassword, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Generate student name based on the username
$studentName = ucfirst($username); // Capitalize the first letter

// Generate a random student ID
$studentID = generateRandomID();

// Save the student ID into the database
saveStudentIDToDatabase($conn, $studentID, $username);

// Close the database connection
$conn->close();

// Function to generate a random student ID
function generateRandomID() {
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $length = 6;
  $randomID = '';
  
  for ($i = 0; $i < $length; $i++) {
    $randomID .= $characters[rand(0, strlen($characters) - 1)];
  }
  
  return $randomID;
}

// Function to save the student ID into the database
function saveStudentIDToDatabase($conn, $studentID, $username) {
  $sql = "UPDATE users SET student_id = '$studentID' WHERE username = '$username'";
  
  if ($conn->query($sql) !== TRUE) {
    echo "Error updating student ID: " . $conn->error;
  }
}
?>

<h1>Welcome to the Dashboard!</h1>

<div class="container">
  <h2>User Information</h2>
  <p>Student Name: <?php echo $studentName; ?></p>
  <p>Student ID: <?php echo $studentID; ?></p>
</div>
<div class="container">
    <h2>Exam</h2>
    <p><a href="exam.php">Take Exam</a></p>
</body>
</html>
