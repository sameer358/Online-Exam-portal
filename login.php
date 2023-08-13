<?php
session_start();

$error = '';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password match a record in the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login, set the username in the session
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid login credentials
        $error = "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>  

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.background {
    background-image: url('login1.jpeg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

header {
    background-color: #7B7D7D;
    padding: 10px;
    color: #fff;
    text-align: center;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-image: linear-gradient(to right, #42557B, #7B7D7D);
}

header h1 {
    margin: 0;
    font-size: 24px;
}

header a {
    color: #fff;
    text-decoration: none;
    margin: 0 10px;
    font-size: 14px;
}

.dashboard {
    background: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
}

.container {
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

.error {
    color: red;
    margin-top: 10px;
    font-size: 14px;
}

footer {
    background-color: #333;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 14px;
}

@media (max-width: 480px) {
    header h1 {
        font-size: 20px;
    }
    
    input[type="text"],
    input[type="password"],
    input[type="submit"] {
        font-size: 14px;
    }
    
    .error {
        font-size: 12px;
    }
}
</style>
<body>
    <!-- Header Section -->
    <header>
        <h1>Login Page Header</h1>
    </header>
    
    <!-- Content Section -->
    <div class="background">
        <div class="dashboard">
            <div class="container">
                <h2>Login Here</h2>
                <?php if (!empty($error)) { ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php } ?>
                <form action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <input type="submit" value="Log in">
                </form>
                <p>Don't have an account? <a href="index.php">Create one</a></p>
                <p>Login as <a href="admin_login.php">Adminstrator</a></p>
            </div>
        </div>
    </div>
    <!-- Footer Section -->
    <footer style="background-color: #333; color: white; padding: 10px; text-align: center;">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All Rights Reserved.</p>
    </footer>
</body>
</html>








