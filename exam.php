<!DOCTYPE html>
<html>
<head>
<header>
    <p>Session Timer: <span id="sessionTimer"></span></p>
    <p>Back to <a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a>
    </p>
  </header>

  <style>
    /* CSS code for online exam portal */

/* Reset default styles for better consistency */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f1f1f1;
  padding: 20px;
}

h1 {
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

form {
  max-width: 600px;
  margin: 0 auto;
  background-color: #fff;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h3 {
  margin-bottom: 10px;
}

.question {
  margin-bottom: 20px;
}

.options label {
  display: block;
  margin-bottom: 8px;
}

.options input[type="radio"] {
  margin-right: 5px;
}

.options label:hover {
  background-color: #f1f1f1;
}

.submit-button {
  margin-top: 20px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 12px 24px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
  width: 100%;
  text-align: center;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

footer {
  text-align: center;
  margin-top: 20px;
  padding: 10px;
  background-color: #f1f1f1;
}

footer a {
  color: #4CAF50;
  text-decoration: none;
}

footer a:hover {
  text-decoration: underline;
}

/* Reset default styles for better consistency */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f1f1f1;
  padding: 20px;
}

h1 {
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

form {
  max-width: 800px;
  margin: 0 auto;
  background-color: #fff;
  border-radius: 5px;
  padding: 30px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h3 {
  margin-bottom: 15px;
}

.question {
  margin-bottom: 20px;
}

.options label {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.options label:hover {
  background-color: #f5f5f5;
}

.options input[type="radio"] {
  margin-right: 10px;
}

.submit-button {
  text-align: center;
  margin-top: 30px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
  width: 100%;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

footer {
  text-align: center;
  margin-top: 30px;
  padding: 10px;
  background-color: #f1f1f1;
}

footer a {
  color: #4CAF50;
  text-decoration: none;
}

footer a:hover {
  text-decoration: underline;
}


  </style>
</head>
<body>
  <h1>CS Exam</h1>
 <?php
  // Database connection configuration
  $host = "localhost";
  $username = "root";
  $password ="root";
  $database = "quiz";

  // Connect to the MySQL database
  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	
	
  }
  session_start(); // Start or resume the session

  // Check if the user is logged in
  if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
  }
  
  // Set the session timer (in seconds)
  $sessionTimeout = 1800; // 30 minutes
  if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $sessionTimeout)) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to the login page
    exit();
  }
  
  $_SESSION['last_activity'] = time(); // Update last activity time
  // Retrieve questions from the database
  $sql = "SELECT * FROM questions";
  $result = $conn->query($sql);

  
 // Display questions in an HTML form
 if ($result->num_rows > 0) {
  echo '<form action="submit_exam.php" method="post" target="result_frame">';
  $questionCounter = 1; // Initialize the question counter

  while ($row = $result->fetch_assoc()) {
    echo '<div class="question">';
    echo '<h3>Question '.$questionCounter.': '.$row['question'].'</h3>'; // Display the question number
    echo '<div class="options">';
    echo '<label>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="1" required>'.$row['option1'];
    echo '</label><br>';
    echo '<label>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="2">'.$row['option2'];
    echo '</label><br>';
    echo '<label>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="3">'.$row['option3'];
    echo '</label><br>';
    echo '<label>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="4">'.$row['option4'];
    echo '</label><br>';
    echo '</div>'; // closing div for options
    echo '</div>'; // closing div for question
    echo '<br>';

    $questionCounter++; // Increment the question counter for the next question
  }

  echo '<div class="submit-button">';
  echo '<input type="submit" value="Submit Exam">';
  echo '</div>';
  echo '</form>';
} else {
  echo '<div class="result" id="result_section">';
  echo 'No questions found.';
  echo '</div>';
}
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve questions from the database
  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve questions from the database
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
  $username = $_SESSION['username']; // Retrieve the username from the session

  // Connect to the MySQL database (if not already connected)
  if (!isset($conn)) {
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  }

// Save the exam result in the exam_results table
$attemptDate = date("Y-m-d"); // Get the current date in YYYY-MM-DD format
$attemptTime = date("H:i:s"); // Get the current time in HH:MM:SS format

$sql = "INSERT INTO exam_results (username, total_questions, correct_answers, score, attempt_date, attempt_time)
        VALUES ('$username', '$totalQuestions', '$correctAnswers', '$score', '$attemptDate', '$attemptTime')
        ON DUPLICATE KEY UPDATE total_questions = '$totalQuestions',
                                correct_answers = '$correctAnswers',
                                score = '$score',
                                attempt_date = '$attemptDate',
                                attempt_time = '$attemptTime'";

if ($conn->query($sql) === false) {
    echo "Error saving the exam result: " . $conn->error;
}


  // Close the database connection
  $conn->close();
}
?>
   <script>
    // JavaScript function to update and display the session timer
    function updateSessionTimer() {
      var sessionTimeout = <?php echo $sessionTimeout; ?>; // Session timeout in seconds
      var currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
      var elapsedTime = currentTime - <?php echo $_SESSION['last_activity']; ?>;
      var remainingTime = sessionTimeout - elapsedTime;

      var minutes = Math.floor(remainingTime / 60);
      var seconds = remainingTime % 60;

      // Update the timer display
      var timerDisplay = document.getElementById("sessionTimer");
      timerDisplay.textContent = minutes + "m " + seconds + "s";

      // Redirect to logout page when session expires
      if (remainingTime <= 0) {
        window.location.href = "logout.php";
      }
    }

    // Update the timer every second
    setInterval(updateSessionTimer, 1000);
    
  </script>
  <footer>
  

    &copy; 2023 Online Exam. All rights reserved
  </footer>
</body>
</html>
