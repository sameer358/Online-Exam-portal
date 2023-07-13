<!DOCTYPE html>
<html>
<head>
  <title>Exam Result</title>
  <style>
    /* Add your CSS styles here */
  </style>
</head>
<body>
  <h1>Exam Result</h1>

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

  // Retrieve questions and answers from the database
  $sql = "SELECT * FROM questions";
  $result = $conn->query($sql);

  // Initialize variables
  $totalQuestions = 0;
  $correctAnswers = 0;

  // Process submitted answers
  while ($row = $result->fetch_assoc()) {
    $questionId = $row['id'];
    $submittedAnswer = $_POST['answer_'.$questionId];
    $correctAnswer = $row['answer'];

    if ($submittedAnswer == $correctAnswer) {
      $correctAnswers++;
    }

    $totalQuestions++;
  }

  // Calculate the score
  $score = ($correctAnswers / $totalQuestions) * 100;
  $score = round($score, 2); // Round to 2 decimal places

  // Display the result
  echo '<p>Total Questions: ' . $totalQuestions . '</p>';
  echo '<p>Correct Answers: ' . $correctAnswers . '</p>';
  echo '<p>Score: ' . $score . '%</p>';

  // Close the database connection
  $conn->close();
  ?>

</body>
</html>
