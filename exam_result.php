<!DOCTYPE html>
<html>
<head>
    <title>Exam Result</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php
// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'quiz';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have the $username variable containing the username of the user whose result you want to display
$username = mysqli_real_escape_string($conn, $username);

// Query to fetch the exam result for the specified username
$sql = "SELECT * FROM exam_results WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the data from the result set
    $row = $result->fetch_assoc();
    ?>
    <h1>Exam Result for <?php echo $row["username"]; ?></h1>
    <table>
        <tr>
            <th>Total Questions</th>
            <th>Correct Answers</th>
            <th>Score</th>
        </tr>
        <tr>
            <td><?php echo $row["total_questions"]; ?></td>
            <td><?php echo $row["correct_answers"]; ?></td>
            <td><?php echo $row["score"]; ?></td>
        </tr>
    </table>
    <?php
} else {
    echo "No result found for the username: " . $username;
}

// Close the database connection
$conn->close();
?>
</body>
</html>
