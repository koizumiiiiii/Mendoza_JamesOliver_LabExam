<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // collect form data
    $fullname = $_POST["fullname"]; 
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

   //Save user data in session
    $_SESSION["users"][$email] = [
        "fullname" => $fullname,
        "username" => $username,
        "email" => $email,
        "password" => $password
    ];

    $_SESSION["message"] = "Registration successful! Please login.";

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCE Register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">

    <div class="left">
        <h1>Create Account</h1>
        <p>Register with Email</p>

        <form action="register.php" method="post">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" class="btn-signup">Sign Up</button>
        </form>
    </div>

    <div class="right">
        <img src="images/CCELogo.png" class="logo">

        <h2>Welcome to CCE</h2>
        <p>Sign in with Email &amp; Password</p>

        <a href="login.php"><button class="btn-signin">Sign In</button></a>
    </div>

</div>

</body>
</html>
