<!DOCTYPE html>
<html>
<head>
  <title>Exam Result</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    header {
      background-color: skyblue;
      color: #fff;
      text-align: center;
      padding: 10px;
    }

    main {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #333;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    footer {
  background-color: #7B7D7D; /* Transparent blue */
  padding: 5px; /* Further decrease the padding */
  color: #fff;
  text-align: center;
  grid-column: 1 / -1;
  /* Add a gradient background */
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
}
   
    header {
  background-color: #7B7D7D; /* Transparent blue */
  padding: 5px; /* Further decrease the padding */
  color: #fff;
  text-align: center;
  border: 1px solid transparent;
  display: flex;
  justify-content: space-between;
  align-items: center;
  /* Add a gradient background */
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
    }
  </style>
</head>
<body>
  <header>
    <h1>Exam Result</h1>
  </header>

  
  <main>

  <?php
session_start();

// Check if the username is set in the session
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

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

// Retrieve the username from the session
$username = $_SESSION['username'];

// Generate student name based on the username
$studentName = ucfirst($username); // Capitalize the first letter

// Retrieve questions, answer options, and correct answers from the database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

// Initialize variables
$totalQuestions = 0;
$correctAnswers = 0;

function is_serialized($data) {
  if (is_string($data) && !empty($data)) {
    return @unserialize($data) !== false;
  }
  return false;
}
function is_json($string) {
  json_decode($string);
  return (json_last_error() === JSON_ERROR_NONE);
}

// Function to check if a string is valid JSON or serialized data
function is_json_or_serialized($data) {
  if (is_string($data) && !empty($data)) {
    // Check if the data is valid JSON
    if (json_decode($data) !== null && json_last_error() === JSON_ERROR_NONE) {
      return true;
    }
    // Check if the data is properly serialized
    if (@unserialize($data) !== false) {
      return true;
    }
  }
  return false;
}


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
$sql = "INSERT INTO exam_results (username, total_questions, correct_answers, score)
        VALUES ('$username', '$totalQuestions', '$correctAnswers', '$score')
        ON DUPLICATE KEY UPDATE total_questions = '$totalQuestions',
                                correct_answers = '$correctAnswers',
                                score = '$score'";

if ($conn->query($sql) === false) {
  echo "Error saving the exam result: " . $conn->error;
}

// Display the overall result
echo '<h2>Exam Result</h2>';
echo '<table>';
echo '<tr><th>Total Questions</th><th>Correct Answers</th><th>Score</th></tr>';
echo '<tr><td>' . $totalQuestions . '</td><td>' . $correctAnswers . '</td><td>' . $score . '%</td></tr>';
echo '</table>';

// Display the question-wise result
echo '<h2>Question-wise Result</h2>';
echo '<table>';
echo '<tr><th>Question</th><th>Your Answer</th><th>Correct Answer</th><th>Result</th></tr>';

// Reset the result pointer to the beginning of the result set
$result->data_seek(0);

while ($row = $result->fetch_assoc()) {
  $questionId = $row['id'];
  $submittedAnswer = $_POST['answer_' . $questionId];
  $correctAnswer = $row['answer'];
  $isCorrect = $submittedAnswer === $correctAnswer;

  echo '<tr>';
  echo '<td>' . $row['question'] . '</td>';
  echo '<td>' . $submittedAnswer . '</td>';
  echo '<td>' . $correctAnswer . '</td>';

  // Show the result (Correct or Incorrect) with different background colors
  if ($isCorrect) {
    echo '<td style="background-color: lightgreen; color: #000;">Correct</td>';
  } else {
    echo '<td style="background-color: lightcoral; color: #000;">Incorrect</td>';
  }

  echo '</tr>';
// Display the answer options for the current question if they exist
echo '<tr><td colspan="4">';
echo '<strong>Answer Options:</strong><br>';
echo '<pre>' . $row['answer_options'] . '</pre>'; // Print the raw data of answer_options

// Check if "answer_options" key exists and attempt to parse as JSON
if (isset($row['answer_options']) && is_json($row['answer_options'])) {
  $answerOptions = json_decode($row['answer_options'], true);
  if (is_array($answerOptions)) {
    foreach ($answerOptions as $option) {
      echo '<label><input type="radio" name="answer_' . $questionId . '" value="' . $option . '"';
      if ($option === $submittedAnswer) {
        echo ' checked'; // Mark the submitted answer as checked
      }
      echo '> ' . $option . '</label><br>';
    }
  } else {
    echo 'Answer options are not in a valid format.';
  }
} else {
  // Handle the case when "answer_options" key does not exist or data is not valid JSON
  echo 'Answer options not available or not properly formatted.';
}

echo '</td></tr>';
}
echo '</table>';

// Close the database connection
$conn->close();
?>


<a class="back-link" href="dashboard.php">Back to Dashboard</a>
    <p>Re-attempt <a href="exam.php">Exam</a></p>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> Online Exam. All rights reserved.
  </footer>
</body>
</html>
