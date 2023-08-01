<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        /* Reset some default styles */
        body, html {
            margin: 0;
            padding: 0;
        }

        /* Holy Grail Layout */
        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 10px;
        }

        .sidebar {
            flex: 0 0 200px; /* Fixed width of the sidebar */
            background-color: #f1f1f1;
            padding: 10px;
        }

        .main {
            flex: 1; /* The main content expands to fill the remaining space */
            max-width: 400px;
            padding: 10px;
        }

        /* Styling for the form */
        form {
            display: flex;
            flex-direction: column;
        }

        form label, form input {
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
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
        /* Footer styling */
        
    </style>
</head>
<body>
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
    if (isset($_POST['username']) && isset($_POST['new_password'])) {
        // Get data from the form
        $username = $_POST['username'];
        $new_password = $_POST['new_password'];

        // Check if the user exists
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Update the user's password in the database
            $sql = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
            if ($conn->query($sql) === TRUE) {
                echo "Password changed successfully!";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "User does not exist.";
        }
    } else {
        echo "Please provide both username and new password.";
    }
}
$conn->close();
?>


    <div class="container">
        <header>
            <!-- Header content goes here (if needed) -->
            <h1>Change Password</h1>
        </header>
        <div class="content">
            <div class="sidebar">
                <!-- Sidebar content goes here (if needed) -->
            </div>
            <div class="main">
                <form action="change_password.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                    
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password">
                    
                    <input type="submit" value="Change Password">
                </form>
            </div>
            <div class="sidebar">
                <!-- Another sidebar content goes here (if needed) -->
            </div>
        </div>
        <footer>
            <p>Back to <a href="user_list.php">User list</a></p>
            &copy; <?php echo date("Y"); ?> Online Exam. All rights reserved.
        </footer>
    </div>
</body>
</html>
