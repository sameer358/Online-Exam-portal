<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
 
 body {
  font-family: Arial, sans-serif;
  margin: 20px;
  background-color: #f5f5f5;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 2em;
  font-weight: bold;
}

h2 {
  margin-top: 40px;
  margin-bottom: 10px;
  font-size: 1.5em;
}

table {
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  border: 1px solid #ccc;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}

form {
  margin-bottom: 30px;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
}

label {
  display: inline-block;
  width: 100px;
}

input[type="text"],
input[type="password"] {
  width: 300px;
  padding: 5px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

footer {
  text-align: center;
  margin-top: 30px;
  padding: 10px;
  border-top: 1px solid #ddd;
  background-color: #f5f5f5;
}

footer a {
  color: #333;
  text-decoration: none;
}

footer a:hover {
  text-decoration: underline;
}
</style>
<body>
    <h1>Welcome to the Admin Dashboard</h1>
    <h2>Student Results</h2>
    <table>
        <!-- Display student results from the database here -->
    </table>

    <p><a href="user_list.php">User List and Result</a></p>
    <table>
        <!-- Display user list from the database here -->
    </table>

    <h2>Add New Question and Answer</h2>
    <form action="add_question.php" method="post">
        <label>Question:</label>
        <input type="text" name="question"><br>
        <label>Option 1:</label>
        <input type="text" name="option1"><br>
        <label>Option 2:</label>
        <input type="text" name="option2"><br>
        <label>Option 3:</label>
        <input type="text" name="option3"><br>
        <label>Option 4:</label>
        <input type="text" name="option4"><br>
        <label>Answer:</label>
        <input type="text" name="answer"><br>
        <input type="submit" value="Add Question">
    </form>

    <h2>Change Password</h2>
    <form action="change_password.php" method="post">
        <label>Username:</label>
        <input type="text" name="username"><br>
        <label>New Password:</label>
        <input type="password" name="new_password"><br>
        <input type="submit" value="Change Password">
    </form>

        
    </form>

    <h2>Delete User Account</h2>
    <form action="delete_user.php" method="post">
        <label>Username:</label>
        <input type="text" name="username"><br>
        <input type="submit" value="Delete User">
    </form>
    
<footer>
    <p>Back to <a href="index.php">Home page</a></p>
    &copy; 2023 Online Exam. All rights reserved.
  </footer>
</body>
</html>
</body>
</html>
