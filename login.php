<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    /* Add your CSS styles here */
  </style>
</head>
<body>
  <h1>Login Page</h1>

  <div class="container">
    <h2>Log in</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Log in">
    </form>
  </div>

  <div class="container">
    <h2>Create an account</h2>
    <form action="signup.php" method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Sign up">
    </form>
  </div>

</body>
</html>
