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

// Generate student name based on the username
$studentName = ucfirst($username); // Capitalize the first letter

// Retrieve the student ID from the database or create a new record if not exists
$studentID = getStudentIDFromDatabase($conn, $username);

// Retrieve the exam result from the database
$examResult = null;
if (!empty($studentID)) {
  $examResult = getExamResultFromDatabase($conn, $studentID);
}

// Function to retrieve the student ID from the database or create a new record if not exists
function getStudentIDFromDatabase($conn, $username) {
  $sql = "SELECT student_id FROM users WHERE username = '$username'";
  $result = $conn->query($sql);

  if ($result === false) {
    echo "Error retrieving student ID: " . $conn->error;
    return null;
  }

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row['student_id'];
  }

  // If the student doesn't exist in the database, create a new record
  $sql = "INSERT INTO users (username) VALUES ('$username')";
  if ($conn->query($sql) === false) {
    echo "Error creating a new student record: " . $conn->error;
    return null;
  }

  return $conn->insert_id;
}

// Function to retrieve the exam result from the database
function getExamResultFromDatabase($conn, $studentID) {
  $sql = "SELECT * FROM exam_results WHERE student_id = '$studentID'";
  $result = $conn->query($sql);

  if ($result === false) {
    echo "Error retrieving exam result: " . $conn->error;
    return null;
  }

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row;
  }

  // If no exam result found, return null
  return null;
}

// Function to display the exam link and logout button
function displayExamLink($studentName) {
  echo '
    <h1>Welcome to the Dashboard!</h1>

    <div class="container">
      <h2>User Information</h2>
      <p>Student Name: ' . $studentName . '</p>
    </div>

    <div class="container">
      <h2>Exam</h2>
      <p><a href="exam.php">Take Exam</a></p>
    </div>

    <div class="container">
      <h2>Logout</h2>
      <p><a href="logout.php">Logout</a></p>
    </div>
  ';
}

// Function to display the exam result and logout button
function displayExamResult($studentName, $studentID, $examResult) {
  echo '
    <h1>Welcome to the Dashboard!</h1>

    <div class="container">
      <h2>User Information</h2>
      <p>Student Name: ' . $studentName . '</p>
      <p>Student ID: ' . $studentID . '</p>
    </div>

    <div class="container">
      <h2>Exam Result</h2>
      <p>Exam Score: ' . $examResult['score'] . '</p>
      <p>Exam Date: ' . $examResult['exam_date'] . '</p>
    </div>

    <div class="container">
      <h2>Logout</h2>
      <p><a href="logout.php">Logout</a></p>
    </div>
  ';
}

// If the student ID is not set, it means the exam hasn't been taken
// Display the exam link
if (empty($studentID)) {
  displayExamLink($studentName);
} else {
  // If the exam result is available, display the result
  if (!empty($examResult)) {
    displayExamResult($studentName, $studentID, $examResult);
  } else {
    // If the exam result is not available, display the pending result message
    echo '<h1>Welcome to the Dashboard!</h1>';
    echo '<div class="container">';
    echo '<h2>User Information</h2>';
    echo '<p>Student Name: ' . $studentName . '</p>';
    echo '<p>Student ID: ' . $studentID . '</p>';
    echo '</div>';
    echo '<div class="container">';
    echo '<h2>Pending Exam Result</h2>';
    echo '<p>Your exam result is not yet available. Please check back later.</p>';
    echo '</div>';
    echo '<div class="container">';
    echo '<h2>Logout</h2>';
    echo '<p><a href="logout.php">Logout</a></p>';
    echo '</div>';
  }
}

// Check if the exam form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($studentID)) {
  // Retrieve questions and answers from the database
  $sql = "SELECT * FROM questions";
  $result = $conn->query($sql);

  // Initialize variables
  $totalQuestions = 0;
  $correctAnswers = 0;

  // Process submitted answers and calculate the score
  while ($row = $result->fetch_assoc()) {
    $questionId = $row['id'];
    $submittedAnswer = $_POST['answer_' . $questionId];
    $correctAnswer = $row['answer'];

    if ($submittedAnswer == $correctAnswer) {
      $correctAnswers++;
    }

    $totalQuestions++;
  }

  // Calculate the score
  $score = ($correctAnswers / $totalQuestions) * 100;
  $score = round($score, 2); // Round to 2 decimal places

  // Save the exam result in the database
  $sql = "INSERT INTO exam_results (student_id, total_questions, correct_answers, score)
          VALUES ('$studentID', '$totalQuestions', '$correctAnswers', '$score')
          ON DUPLICATE KEY UPDATE total_questions = '$totalQuestions',
                                  correct_answers = '$correctAnswers',
                                  score = '$score'";

  if ($conn->query($sql) === false) {
    echo "Error saving the exam result: " . $conn->error;
  } else {
    // Display the exam result after submission
    displayExamResult($studentName, $studentID, array('score' => $score, 'exam_date' => date('Y-m-d H:i:s')));
  }
}

// Close the database connection
$conn->close();
?>
</body>
</html>
