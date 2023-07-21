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
      background-color: skyblue;
      color: #fff;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
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

    // Retrieve the student ID from the database or create a new record
    $studentID = getStudentIDFromDatabase($conn, $username);

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

    // Display the result in a table
    echo '<table>';
    echo '<tr><th>Total Questions</th><th>Correct Answers</th><th>Score</th></tr>';
    echo '<tr><td>' . $totalQuestions . '</td><td>' . $correctAnswers . '</td><td>' . $score . '%</td></tr>';
    echo '</table>';


    // ... (Previous PHP code for database connection, student ID retrieval, etc.) ...
  
    // Display the result in a table with correct and incorrect answers
    echo '<table>';
    echo '<tr><th>Question</th><th>Your Answer</th><th>Correct Answer</th><th>Result</th></tr>';
  
    // Retrieve questions and answers from the database
    $sql = "SELECT * FROM questions";
    $result = $conn->query($sql);
  
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
    }
  
    echo '</table>';
  
    // ... (The rest of the PHP code remains the same) ...
  
  
  

    // Close the database connection
    $conn->close();
    ?>

    <p>Back to <a href="dashboard.php">Dashboard</a></p>
    <p>Try once again <a href="exam.php">Exam</a></p>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> Online Exam. All rights reserved.
  </footer>
</body>
</html>
