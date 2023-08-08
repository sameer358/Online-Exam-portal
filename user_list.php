<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Layout styles */
        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
  background-color: #7B7D7D; /* Transparent blue */
  padding: 5px; /* Further decrease the padding */
  color: #fff;
  text-align: center;
  border: 1px solid transparent;
  display: flex;
  justify-content: space-between;
  align-items: center;
  /* Add a gradient background */
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
}

        .main-content {
            flex: 1;
            display: flex;
        }

        .left-sidebar,
        .right-sidebar {
            background-color: #f2f2f2;
            padding: 10px;
        }

        .center-content {
            flex: 1;
            padding: 20px;
        }

        /* Table styles */
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .user-table th,
        .user-table td {
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
            padding: 4px 8px;
            border: 1px solid #333;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .user-table td a:hover {
            text-decoration: none;
            background-color: #333;
            color: #fff;
        }

        footer {
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        footer {
  background-color: #7B7D7D; /* Transparent blue */
  padding: 5px; /* Further decrease the padding */
  color: #fff;
  text-align: center;
  grid-column: 1 / -1;
  /* Add a gradient background */
  background-image: linear-gradient(to right, #42557B, #7B7D7D);
}

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the User List</h1>
        </header>
        <div class="main-content">
            <div class="left-sidebar">
                <!-- You can add content to the left sidebar here if needed -->
            </div>
            <div class="center-content">
                <?php
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
            </div>
            <div class="right-sidebar">
                <!-- You can add content to the right sidebar here if needed -->
                
            </div>
        </div>
        <footer>
            <p>Back to <a href="admin_dashboard.php">Admin Dashboard</a></p>
            &copy; <?php echo date('Y'); ?> Online Exam. All rights reserved.
        </footer>
    </div>
</body>
</html>
