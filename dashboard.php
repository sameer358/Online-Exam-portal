<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    /* Add your CSS styles here */
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

// Function to generate a student ID
function generateStudentID($prefix) {
  $randomNumber = mt_rand(10000, 99999);
  return $prefix . $randomNumber;
}

// Check if the student ID exists in the database
$sql = "SELECT student_id FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result === false) {
  die("Error retrieving student ID: " . $conn->error);
}

if ($result->num_rows === 0) {
  // Generate a new student ID and insert it into the database
  $studentID = generateStudentID('STU');
  $sql = "INSERT INTO users (username, student_id) VALUES ('$username', '$studentID')";
  if ($conn->query($sql) === false) {
    die("Error creating a new student record: " . $conn->error);
  }
} else {
  // Student ID already exists, retrieve it from the database
  $row = $result->fetch_assoc();
  $studentID = $row['student_id'];
}

// Display the student dashboard with the exam link if the student ID is not set
echo '
  <h1>Welcome to the Dashboard!</h1>

  <div class="container">
    <h2>User Information</h2>
    <p>Student Name: ' . ucfirst($username) . '</p>
    <p>Student ID: ' . $studentID . '</p>
  </div>
';

if (empty($studentID)) {
  echo '
    <div class="container">
      <h2>Exam</h2>
      <p><a href="exam.php">Take Exam</a></p>
    </div>
  ';
}

echo '
  <div class="container">
    <h2>Logout</h2>
    <p><a href="logout.php">Logout</a></p>
  </div>
';

// Close the database connection
$conn->close();
?>
