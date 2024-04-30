<?php
include('database_connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $fname  = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $telephone = mysqli_real_escape_string($connection, $_POST['telephone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $activation_code = mysqli_real_escape_string($connection, $_POST['activation_code']);
    
    // Preparing SQL query
    $sql = "INSERT INTO user (firstname, lastname, email, username, password, telephone, activation_code) VALUES ('$fname','$lname','$email', '$username', '$password','$telephone','$activation_code')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
