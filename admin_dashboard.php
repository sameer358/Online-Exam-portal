<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header Styles */
header {
    background-image: linear-gradient(to right, #42557B, #7B7D7D);
    padding: 15px;
    color: #fff;
    text-align: center;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ccc;
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

/* Sidebar Styles */
.left-sidebar,
.right-sidebar {
    flex-basis: 200px;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 0 20px;
}

/* Main Content Styles */
.main-content {
    flex: 1;
    display: flex;
    justify-content: space-between;
    padding: 20px;
}

/* Form Styles */
form {
    margin-bottom: 30px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: inline-block;
    width: 100px;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Feedback Table Styles */
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

/* Footer Styles */
footer {
    background-image: linear-gradient(to right, #42557B, #7B7D7D);
    padding: 5px;
    color: #fff;
    text-align: center;
    grid-column: 1 / -1;
}
footer a:hover {
    text-decoration: underline;
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
            <h2>Question Secation</h2>
            <form action="view_questions.php" method="post">
                    <input type="submit" value="View All Question Here ">
    </form>
    <form action="all_question.php" method="post">
                    <input type="submit" value="Edit and Delete ">
    </form>
            </div>

            <form action="add_question.php" method="post">
            <h2>Add New Question and Answer</h2>
    <label>Question:</label>
    <input type="text" name="question" required><br>
    <label>Option 1:</label>
    <input type="text" name="option1" required><br>
    <label>Option 2:</label>
    <input type="text" name="option2" required><br>
    <label>Option 3:</label>
    <input type="text" name="option3" required><br>
    <label>Option 4:</label>
    <input type="text" name="option4" required><br>
    <label>Correct Option:</label>
<select name="correct_option" required>
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
    <option value="3">Option 3</option>
    <option value="4">Option 4</option>
</select><br>

    <input type="submit" value="Add Question">
</form>




            <div class="right-sidebar">
                <h2>Manage User</h2>
                <form action="user_list.php" method="post">
                    <input type="submit" value="All User List">
    </form>
                <form action="admin_exam_result.php" method="post">
                    <input type="submit" value="All User Result">
                </form>
            </div>
        </div>


    <form action="add_question.php" method="post">
        <!-- ... Existing form to add a question ... -->
    </form>

    <!-- Display Feedback Data -->
    <div class="right-sidebar">
        <h2>Feedback Data</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Feedback</th>
            </tr>
            <?php
            // Database connection configuration
            $host = 'localhost';
            $username = 'root';
            $password = 'root';
            $database = 'quiz';

            $conn = new mysqli($host, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve feedback data from the database
            $sql = "SELECT * FROM feedback";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['feedback'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3">No feedback data available</td></tr>';
            }

            $conn->close();
            ?>
        </table>
    </div>
</div>

<!-- ... Footer and closing tags ... -->

        <footer>
            <p>Back to <a href="index.php">Home page</a></p>
            &copy; 2023 Online Exam. All rights reserved.
        </footer>
    </div>
</body>
</html>
