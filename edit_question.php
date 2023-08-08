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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $questionId = $_POST['question_id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option_index = $_POST['correct_option'];

    // Update data in the 'questions' table using prepared statements
    $sql = "UPDATE questions SET question=?, option1=?, option2=?, option3=?, option4=?, answer=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in prepared statement: " . $conn->error);
    }

    $stmt->bind_param("ssssssi", $question, $option1, $option2, $option3, $option4, $correct_option_index, $questionId);

    if ($stmt->execute()) {
        header("Location: view_questions.php"); // Redirect to question listing page
        exit();
    } else {
        $error_msg = "Error updating question: " . $stmt->error;
    }

    $stmt->close();
}

// Retrieve question data based on the provided question ID
if (isset($_GET['id'])) {
    $questionId = $_GET['id'];

    $sql = "SELECT * FROM questions WHERE id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in prepared statement: " . $conn->error);
    }

    $stmt->bind_param("i", $questionId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $question = $row['question'];
        $option1 = $row['option1'];
        $option2 = $row['option2'];
        $option3 = $row['option3'];
        $option4 = $row['option4'];
        $correct_option_index = $row['answer'];
    } else {
        die("Question not found.");
    }

    $stmt->close();
} else {
    die("No question ID provided.");
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        .error-msg {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
        label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
<body>
    <h1>Edit Question</h1>
    <?php if (isset($error_msg)) { echo '<div class="error-msg">' . $error_msg . '</div>'; } ?>
    <form method="post">
        <input type="hidden" name="question_id" value="<?php echo $questionId; ?>">
        Question: <input type="text" name="question" value="<?php echo $question; ?>"><br>
        Option 1: <input type="text" name="option1" value="<?php echo $option1; ?>"><br>
        Option 2: <input type="text" name="option2" value="<?php echo $option2; ?>"><br>
        Option 3: <input type="text" name="option3" value="<?php echo $option3; ?>"><br>
        Option 4: <input type="text" name="option4" value="<?php echo $option4; ?>"><br>
        Correct Option: <input type="number" name="correct_option" value="<?php echo $correct_option_index; ?>"><br>
        <input type="submit" value="Update Question">
    </form>
</body>
</html>
