<!DOCTYPE html>
<html>
<head>
  <title>Online Exam</title>
  <header>
  <br>
  <h1>Online Exam</h1>

</header>

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
      background-color: skyblue;
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

    /* Additional CSS styles for exam dashboard look */
    .dashboard {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .dashboard .container {
      flex-basis: 48%;
      margin-bottom: 20px;
    }

    .dashboard .container h2 {
      font-size: 24px;
      margin-bottom: 15px;
    }

    .dashboard .container form {
      margin-top: 20px;
    }

    .dashboard .container input[type="submit"] {
      font-size: 16px;
    }

    /* Style the "Login as Admin" link */
    .login-admin-link {
      float: right;
      color: #333;
      text-decoration: none;
      font-size: 16px;
    }

    .login-admin-link:hover {
      color: #4caf50;
    }
  </style>
</head>
<body>
<div class="dashboard">
    <div class="container">
      <h2>Create Account</h2>
      <form action="create_account.php" method="POST">
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
  </div>

  <footer>
  <p>Login as <a href="admin_login.php">Admin</a></p>
    &copy; 2023 Online Exam. All rights reserved.
  </footer>
</body>
</html>
