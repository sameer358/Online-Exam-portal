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

// Retrieve the student ID from the session or create a new one if not exists
$studentID = getStudentIDFromSession();

// Function to retrieve the student ID from the session or create a new one if not exists
function getStudentIDFromSession() {
  if (!isset($_SESSION['student_id'])) {
    // Generate a random student ID based on timestamp and a random number
    $studentID = time() . rand(1000, 9999);
    $_SESSION['student_id'] = $studentID;
  } else {
    $studentID = $_SESSION['student_id'];
  }
  return $studentID;
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
  }
}

// Retrieve the exam result from the database
$examResult = getExamResultFromDatabase($conn, $studentID);

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

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <!-- Add your CSS styles here -->
</head>
<body>
  <?php
  if (empty($examResult)) {
    // If the exam result is not available or not yet taken, display the exam link
    ?>
    <h1>Welcome to the Dashboard!</h1>

    <div class="container">
      <h2>User Information</h2>
      <p>Student Name: <?php echo $studentName; ?></p>
    </div>

    <div class="container">
      <h2>Exam</h2>
      <form action="" method="post">
        <!-- Replace this section with the actual exam questions and answers -->
        <!-- Example Question 1 -->
        <p>Question 1: What is the capital of France?</p>
        <input type="radio" name="answer_1" value="Paris"> Paris<br>
        <input type="radio" name="answer_1" value="London"> London<br>
        <input type="radio" name="answer_1" value="Berlin"> Berlin<br>

        <!-- Example Question 2 -->
        <p>Question 2: What is 2 + 2?</p>
        <input type="radio" name="answer_2" value="3"> 3<br>
        <input type="radio" name="answer_2" value="4"> 4<br>
        <input type="radio" name="answer_2" value="5"> 5<br>

        <!-- Add more questions and answers as needed -->

        <input type="submit" value="Submit Exam">
      </form>
    </div>

    <div class="container">
      <h2>Logout</h2>
      <p><a href="logout.php">Logout</a></p>
    </div>
  <?php
  } else {
    // If the exam result is available, display the result
    ?>
    <h1>Welcome to the Dashboard!</h1>

    <div class="container">
      <h2>User Information</h2>
      <p>Student Name: <?php echo $studentName; ?></p>
      <p>Student ID: <?php echo $studentID; ?></p>
    </div>

    <div class="container">
      <h2>Exam Result</h2>
      <p>Exam Score: <?php echo $examResult['score']; ?></p>
      <p>Exam Date: <?php echo $examResult['exam_date']; ?></p>
    </div>

    <div class="container">
      <h2>Logout</h2>
      <p><a href="logout.php">Logout</a></p>
    </div>
  <?php
  }
  ?>
</body>
</html>
