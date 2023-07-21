<?php
echo"Welcome to the User List";
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

// Retrieve the user list from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if any users are found
if ($result->num_rows > 0) {
    // User list found, display the table
    echo '<table class="user-table">';
    echo '<tr><th>User ID</th><th>Username</th><th>Action</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td><a href="change_password.php?id=' . $row['id'] . '">Change Password</a> | <a href="delete_user.php?id=' . $row['id'] . '">Delete</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    // No users found
    echo 'No users found.';
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        /* Dashboard styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .user-table th, .user-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #f2f2f2;
        }

        .user-table td a {
            color: #333;
            text-decoration: none;
        }

        .user-table td a:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        footer a {
            color: #333;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
// The PHP code with database connection is already included above
?>
<footer>
    <p>Back to <a href="admin_dashboard.php">Admin Dashboard</a></p>
    &copy; 2023 Online Exam. All rights reserved.
</footer>
</body>
</html>
