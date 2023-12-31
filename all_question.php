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
// Handle delete action if an ID is provided
if(isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteSql = "DELETE FROM questions WHERE id = $deleteId";
    
    if ($conn->query($deleteSql)) {
        header("Location: all_question.php"); // Redirect back to the same page after deleting
        exit();
    } else {
        echo "Error deleting question: " . $conn->error;
    }
}
// Fetch questions from the database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching questions: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Questions</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            text-decoration: none;
            color: blue;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
<body>
    <h1>Quiz Questions</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Correct Option</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['question']; ?></td>
                <td><?php echo $row['option1']; ?></td>
                <td><?php echo $row['option2']; ?></td>
                <td><?php echo $row['option3']; ?></td>
                <td><?php echo $row['option4']; ?></td>
                <td><?php echo $row['answer']; ?></td>
                <td><a href="edit_question.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                <td><a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a></td>
            
            </tr>
        <?php } ?>
    </table>
    <p class="login-link">Back to <a href="admin_dashboard.php">Dashboard</a></p>
</body>
</html>

<?php
$conn->close();
?>
