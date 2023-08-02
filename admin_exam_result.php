<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Student Exam Results</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Total Questions</th>
        <th>Correct Answers</th>
        <th>Score</th>
        <th>Attempt Date</th>
        <th>Attempt Time</th>
    </tr>
    <?php
    // Database connection configuration
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'quiz';

    // Create a connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve all student results
    $sql = "SELECT * FROM exam_results ORDER BY attempt_date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['total_questions'] . "</td>";
            echo "<td>" . $row['correct_answers'] . "</td>";
            echo "<td>" . $row['score'] . "</td>";
            echo "<td>" . $row['attempt_date'] . "</td>";
            echo "<td>" . $row['attempt_time'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No results found</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>
</table>
<a class="back-link" href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
