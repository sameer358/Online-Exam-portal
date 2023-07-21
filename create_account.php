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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Insert user into the database
  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  if ($conn->query($sql) === TRUE) {
    echo "User created successfully." ;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 20px;
    }

    h3 {
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }

    p {
      text-align: center;
    }

    a {
      color: #333;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
 
</html>


<?php
    // Include the login.php content
    include('login.php');
  ?>