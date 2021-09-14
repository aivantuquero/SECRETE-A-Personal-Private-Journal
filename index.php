<?php

include 'resources/db_config.php';

error_reporting(0);

session_start();

// check if user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
}

//check if login has failed
if (isset($_SESSION['BadLogin'])) {
    $err = "Invalid Credentials!";
}

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resources/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Secrete - Login</title>
</head>

<body>
    <!-- Main Window -->
    <div class="bg">
        <div class="panel">
        <img src="resources/images/logo.png" alt="logo">
            <div class="content">
                <form action="LogRegProcess.php" onsubmit="return validateLogin()" method="post">
                    <input class="inputfield" id="email" type="text" name="email" placeholder="Email" required><br>
                    <input class="inputfield" id="password" type="password" name="password" placeholder="Password" required><br>
                    <input id="loginbtn" name="login" type="submit" value="Login">
                </form>

                <p id="err" style="color:red;"><?php echo($err); ?></p>
                <br>

                <p>New User?</p>
                <a href="signup.php">Create an accout!</a>
            </div>

        </div>
    </div>

    <!-- Footer -->

    <footer>

        <div>
            <a href="https://github.com/aivantuquero"><i class="bi bi-github"></i></a>
            <a href="https://ph.linkedin.com/in/aivantuquero"><i class="bi bi-linkedin"></i></a>
        </div>
        <p>Made with <span><i style="color:red" class="bi bi-suit-heart-fill"></i></span> by Aivan Carlos Tuquero</p>

    </footer>

    <script type="text/javascript" src="resources/main.js"></script>
</body>

</html>