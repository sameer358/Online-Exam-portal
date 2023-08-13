<!DOCTYPE html>
<html>
<head>
    <title>Exam Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        /* Styling for the exam result container */
        .result-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styling for back to dashboard link */
        .back-link {
            display: block;
            margin-top: 20px;
        }
    </style>  <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        /* Styling for the exam result container */
        .result-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styling for back to dashboard link */
        .back-link {
            display: block;
            margin-top: 20px;
        }
        
    </style>
</head>
<body>

<div class="result-container">

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

// Retrieve the username from the URL parameter
if (isset($_GET['username'])) {
    $username = mysqli_real_escape_string($conn, $_GET['username']); // Get the username from the query parameter
    // Query to fetch all exam results for the specified username
    $sql = "SELECT * FROM exam_results WHERE username = '$username' ORDER BY attempt_date DESC, attempt_time DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?>
        <h1>Exam Results for <?php echo $username; ?></h1>
        <table>
            <tr>
                <th>Attempt Date</th>
                <th>Total Questions</th>
                <th>Correct Answers</th>
                <th>Score</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["attempt_date"] . ' ' . $row["attempt_time"]; ?></td>


                    <td><?php echo $row["total_questions"]; ?></td>
                    <td><?php echo $row["correct_answers"]; ?></td>
                    <td><?php echo $row["score"]; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        echo "No results found for the username: " . $username;
    }
} else {
    echo "Username parameter is missing.";
}
// Close the database connection
$conn->close();
?>

<a class="back-link" href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>
