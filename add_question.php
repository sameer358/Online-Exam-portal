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
$correct_option_index = $_POST['correct_option'];

// Insert data into the 'question' table using prepared statements
$sql = "INSERT INTO questions (question, option1, option2, option3, option4, answer) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in prepared statement: " . $conn->error);
}

$stmt->bind_param("ssssss", $question, $option1, $option2, $option3, $option4, $correct_option_index);

if ($stmt->execute()) {
    echo '<div class="success-msg">Question added successfully!</div>';

    // Get the correct answer based on the provided index
    $options = [$option1, $option2, $option3, $option4];
    $correct_answer = $options[$correct_option_index - 1]; // Index is 1-based
} else {
    echo '<div class="error-msg">Error: ' . $stmt->error . '</div>';
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <header>
    <p>All Question List <a href="all_question.php">Here</a></p>
    <style>
        /* Add your CSS styles here */
        .success-msg {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .error-msg {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    if (isset($correct_answer)) {
        echo '<table>';
        echo '<tr><th colspan="2">Question Details</th></tr>';
        echo '<tr><td>Question:</td><td>' . $question . '</td></tr>';
        echo '<tr><td>Options:</td><td>' . implode(', ', $options) . '</td></tr>';
        echo '<tr><td>Correct Answer:</td><td>' . $correct_answer . '</td></tr>';
        echo '</table>';
    }
    ?>

    <footer>
        <p>Back to <a href="admin_dashboard.php">Admin Dashboard</a></p>
        &copy; 2023 Online Exam. All rights reserved.
    </footer>
</body>
</html>
