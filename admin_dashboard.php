<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
      form {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
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
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            background-color: #7B7D7D;
            padding: 5px;
            color: #fff;
            text-align: center;
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

        /* Holy Grail layout styles */

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

        .logout-btn {
            padding: 5px 10px;
            background-color: #444;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #666;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .left-sidebar,
        .right-sidebar {
            flex-basis: 200px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .left-sidebar {
            margin-right: 20px;
        }

        .right-sidebar {
            margin-left: 20px;
        }

        .main-content form {
            flex: 1;
            max-width: 400px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Admin Dashboard</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </header>

        <div class="main-content">
            <div class="left-sidebar">
                <h2>Student Results</h2>
                <table>
                    <!-- Display student results from the database here -->
                </table>

                <p><a href="user_list.php">User List</a></p>
                <table>
                    <!-- Display user list from the database here -->
                </table>
            </div>

            <form action="add_question.php" method="post">
                <h2>Add New Question and Answer</h2>
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

            <div class="right-sidebar">
                <h2>Change Password</h2>
                <form action="change_password.php" method="post">
                    <label>Username:</label>
                    <input type="text" name="username"><br>
                    <label>New Password:</label>
                    <input type="password" name="new_password"><br>
                    <input type="submit" value="Change Password">
                </form>

                <h2>Delete User Account</h2>
                <form action="delete_user.php" method="post">
                    <label>Username:</label>
                    <input type="text" name="username"><br>
                    <input type="submit" value="Delete User">
                </form>
            </div>
        </div>

        <footer>
            <p>Back to <a href="index.php">Home page</a></p>
            &copy; 2023 Online Exam. All rights reserved.
        </footer>
    </div>
</body>
</html>
