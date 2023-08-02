<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Feedback Form</h2>
    <?php
    // Database connection configuration
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'quiz';

    // Initialize variables to hold form data
    $name = $email = $feedback = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Create a connection to the database
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data and sanitize
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

        // Insert feedback into the feedback table
        $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";

        if ($conn->query($sql) === true) {
            echo "<p class='success'>Feedback submitted successfully.</p>";
        } else {
            echo "<p class='error'>Error submitting feedback: " . $conn->error . "</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback" rows="4" required><?php echo $feedback; ?></textarea>

        <button type="submit">Submit Feedback</button>
    </form>
</div>
<a class="back-link" href="index.php">Back to Homepage</a>
</body>
</html>
