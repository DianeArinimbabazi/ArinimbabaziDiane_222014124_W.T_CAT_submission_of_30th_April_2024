<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Register or Login Page</title>
<style>
  /* Styling for the body */
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: url('2.jpg') center/cover no-repeat; /* Background image */
    color: #FFFFFF; /* White text color */
    background-blend-mode: overlay;
    height: 100vh;
  }

  /* Styling for the overlay */
  .overlay {
    background-color: rgba(0, 0, 0, 0.5); /* Overlay color with 50% opacity */
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1; /* Ensure overlay is above the background */
  }

  /* Styling for the container */
  .container {
    position: relative;
    z-index: 2; /* Ensure container is above the overlay */
  }

  /* Heading style */
  h1 {
    font-size: 3rem;
    margin-bottom: 20px;
  }

  /* Paragraph style */
  p {
    font-size: 1.2rem;
    margin-bottom: 30px;
  }

  /* Button style */
  .btn {
    display: inline-block;
    padding: 30px 75px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    text-decoration: none;
    color: black; /* Black text color */
    background-color: #FFFFFF; /* White button background color */
    transition: background-color 0.3s ease;
  }

  /* Hover effect for login button */
  .btn-login:hover {
    background-color: beige; /* Beige background color on hover */
    box-shadow: 2px;
  }

  /* Styling for the register button */
  .btn-register {
    background-color: beige; /* Beige button background color */
    margin-left: 20px;
  }

  /* Hover effect for register button */
  .btn-register:hover {
    background-color: #666666; /* Darker black background color on hover */
  }

  /* Keyframes for sliding images */
  @keyframes slideImages {
    0%, 33.33% {
        background-image: url('image4.jpg');
    }
    33.33%, 66.66% {
        background-image: url('image4.jpg');
    }
    66.66%, 100% {
        background-image: url('image4.jpg');
    }
  }

  /* Keyframes for moving text */
  @keyframes move {
    0% { transform: translateY(-50%); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
  }

  /* Styling for moving text animation */
  .moving-text {
    animation: move 10s infinite alternate;
  }
</style>
</head>
<body style="background-image: url('./Images/image4.png');background-repeat: no-repeat;background-size: cover;">
<header>
  <h1> HOME PAGE </h1>
</header>
<div class="overlay">
  <div class="container">
    <!-- Empty heading for now -->
    <h1 style="color: black;"></h1>

    <!-- Register and login buttons -->
    <a href="register.html" class="btn btn-register">Register</a>
    <a href="login.html" class="btn btn-login">Login</a>
  </div>
</div>

</body>
</html>
