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

// Prepare the exam result data
$report = "ID,Username,Total Questions,Correct Answers,Score,Attempt Date,Attempt Time\n";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $report .= $row['id'] . "," . $row['username'] . "," . $row['total_questions'] . ","
            . $row['correct_answers'] . "," . $row['score'] . ","
            . $row['attempt_date'] . "," . $row['attempt_time'] . "\n";
    }
}

// Close the connection
$conn->close();

// Generate the CSV file and offer it for download
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=exam_results_report.csv");
header("Pragma: no-cache");
header("Expires: 0");

echo $report;
?>
