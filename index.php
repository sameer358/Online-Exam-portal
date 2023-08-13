<!DOCTYPE html>
<html>
<head>
  <title>eExam Portal</title>
  <style>
    /* CSS styles for header and footer */
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
header a {
  color: #fff;
  text-decoration: none;
  margin: 0 5px; /* Further decrease the margin */
  font-size: 14px; /* Further decrease the font size */
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
    header a:hover {
      text-decoration: underline;
    }

    .menu {
      display: flex;
      align-items: center;
    }

    /* Additional CSS styles */
    body {
      font-family: Arial, sans-serif;
      background-color: transparent; /* Transparent background */
      background-image: url("login1.jpeg");
      margin: 0;
      padding: 0;
      display: grid;
      grid-template-columns: 1fr minmax(0, 600px) 1fr;
      grid-template-rows: auto 1fr auto;
      min-height: 100vh;
    }
 

    .container {
      max-width: 400px;
      background-color: rgba(255, 255, 255, 0.9); /* Transparent white */
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
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
    background-color: #0056b3;
}
   

    .dashboard .container {
      flex-basis: 100%;
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
      color: #007bff;
      
    }

    /* Additional CSS styles for the "Login here" link */
    p.login-link {
      text-align: center;
      margin-top: 10px;
    }

    p.login-link a {
      color: #4caf50;
      text-decoration: none;
    }

    p.login-link a:hover {
      text-decoration: underline;
    }

    /* CSS Grid layout areas */
    header {
      grid-column: 1 / -1;
    }


    .dashboard {
      grid-column: 2 / 3;
      grid-row: 2 / 3;
    }

    footer {
      grid-column: 1 / -1;
    }
 
  </style>
</head>
<body>
<header>
  <h1>eExam Portal</h1>
  <div class="menu">
    <a href="admin_login.php">Login as Admin</a>
    <a href="feedback.php">Feedback</a>
    <a href="#">About Us</a>
  </div>
</header>

<div class="dashboard">
  <div class="container">
    <h2>Create an account</h2>
    <form action="create_account.php" method="POST">
    <input type="text" name="full_name" placeholder="Full Name" required><br>
    <input type="text" name="email" placeholder="email" required><br>
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Signup">
    </form>
    
    <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
  </div>
</div>

<footer>
  &copy; 2023 Online Exam. All rights reserved.
</footer>
</body>
</html>