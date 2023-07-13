<!DOCTYPE html>
<html>
<head>
  <title>Online Exam</title>
  <style>
    /* CSS styles for header and footer */
    header {
      background-color: skyblue;
      padding: 10px;
      color: #fff;
      text-align: center;
      border: 1px solid transparent;
      position: relative;
    }

    footer {
      background-color: #333;
      padding: 10px;
      color: #fff;
      text-align: center;
    }

    /* Additional CSS styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 400px;
      margin: 20px auto;
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .admin-login {
      text-align: right;
    }

    .admin-login form {
      display: inline-block;
    }

    .admin-login input[type="text"],
    .admin-login input[type="password"],
    .admin-login input[type="submit"] {
      margin: 5px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Online Exam</h1>
  </header>

  <div class="container">
    <h2>Signup</h2>
    <form action="signup.php" method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Signup">
    </form>
  </div>

  <div class="container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
    </form>
  </div>

  <div class="admin-login">
    <form action="admin_login.php" method="POST">
      <input type="text" name="admin_username" placeholder="Admin Username" required>
      <input type="password" name="admin_password" placeholder="Admin Password" required>
      <input type="submit" value="Admin Login">
    </form>
  </div>

  <footer>
    &copy; 2023 Online Exam. All rights reserved.
  </footer>
</body>
</html>
