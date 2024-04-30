<?php
session_start(); // Starting the session
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Prepare and execute SQL statement to prevent SQL injection
    $sql = "SELECT id, email, password FROM user WHERE email=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: home.html"); // Redirect to home page after successful login
            exit();
        } else {
            $error = "Invalid email or password"; // Set error message if password is incorrect
        }
    } else {
        $error = "User not found"; // Set error message if user does not exist
    }
} else {
    // Optional: Provide a default error message for non-POST requests
    $error = "";
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body style="background-image: url('./Images/image15.png');background-repeat: no-repeat;background-size:cover;">
    <h2>Login Form</h2>
    <form method="post" action="">
        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <?php if (!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>
