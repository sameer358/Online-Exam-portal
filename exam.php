<!DOCTYPE html>
<html>
<head>
  <title>Online Exam</title>

  <style>
    /* CSS code for online exam portal */

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

form {
  background-color: #fff;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h3 {
  margin-bottom: 10px;
}

input[type="radio"] {
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

/* Optional: Add more styles as per your preference */

  </style>
</head>
<body>
  <h1>Online Exam</h1>
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

  // Close the database connection
  $conn->close();
  ?>
  <footer>
    <p>Back to <a href="dashboard.php">Dashboard</a></p>
    &copy; 2023 Online Exam. All rights reserved.
  </footer>
</body>
</html>
