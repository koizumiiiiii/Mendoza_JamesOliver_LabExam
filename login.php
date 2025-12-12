<?php
session_start();

$error = "";
$success = "";

if (isset($_POST['signin'])) {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Basic validation
    if (empty($email) || empty($password)) {
        $error = "Please enter both Email and Password.";
    } else {

        // Check if user exists in session
        if (isset($_SESSION["users"][$email])) {

            $user = $_SESSION["users"][$email];

            // Verify password
            if (password_verify($password, $user["password"])) {

                $_SESSION["logged_in"] = true;
                $_SESSION["username"] = $user["username"];
                $_SESSION["email"] = $email;

                $success = "Login Successful!";

            } else {
                $error = "Incorrect password!";
            }

        } else {
            $error = "Email not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCE Login</title>
    <link rel="stylesheet" href="login.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">

    <div class="left">
        <h1>Sign In</h1>
        <p>Sign in with Email &amp; Password</p>

        <!-- Error Message -->
        <?php if (!empty($error)): ?>
            <p style="color:red; font-weight:600;"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Success Message -->
        <?php if (!empty($success)): ?>
            <p style="color:green; font-weight:600;"><?php echo $success; ?></p>
        <?php endif; ?>

        <!-- Registration Success Message -->
        <?php 
        if (!empty($_SESSION["message"])) {
            echo "<p style='color:green; font-weight:600;'>".$_SESSION["message"]."</p>";
            unset($_SESSION["message"]);
        }
        ?>

        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Enter Email">
            <input type="password" name="password" placeholder="Enter Password">
            <button type="submit" name="signin" value="signin" class="btn-signin">Sign In</button>
        </form>

    </div>

    <div class="right">
        <img src="images/CCELogo.png" class="logo">
        <h2>Welcome to CCE</h2>
        <p>Sign up now and enjoy our site</p>
        <a href="register.php">
            <button class="btn-signup">Sign Up</button>
        </a>
    </div>
</div>

</body>
</html>
