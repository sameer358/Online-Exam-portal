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

// Query to retrieve questions from the database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

// Display questions in the user portal
if ($result->num_rows > 0) {
  echo '<h1>User Portal</h1>';
  echo '<form action="submit_exam.php" method="post">';
  while ($row = $result->fetch_assoc()) {
    echo '<h3>'.$row['question'].'</h3>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="1" required>'.$row['option1'].'<br>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="2">'.$row['option2'].'<br>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="3">'.$row['option3'].'<br>';
    echo '<input type="radio" name="answer_'.$row['id'].'" value="4">'.$row['option4'].'<br>';
    echo '<br>';
  }
  echo '<input type="submit" value="Submit Exam">';
  echo '</form>';
} else {
  echo 'No questions found.';
}

// Close the database connection
$conn->close();
?>
