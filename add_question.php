<?php
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'quiz';

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ...
// Get data from the form
$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correct_option_index = $_POST['correct_option'];  // Capture the option index

// Insert data into the 'question' table using prepared statements
$sql = "INSERT INTO questions (question, option1, option2, option3, option4, answer) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in prepared statement: " . $conn->error);
}

$stmt->bind_param("ssssss", $question, $option1, $option2, $option3, $option4, $correct_option_index);  // Store index in the 'answer' column

if ($stmt->execute()) {
    echo "Question added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
// ...
?>


<html>
    <body>
<footer>
    <p>Back to <a href="admin_dashboard.php">Admin Dashboard</a></p>
    &copy; 2023 Online Exam. All rights reserved.
  </footer>
</body>
</html>