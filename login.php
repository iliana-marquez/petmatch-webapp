<?php
session_start(); 
require_once "db_connect.php";

if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit(); 
}

if (isset($_SESSION["admn"])) {
    header("Location: dashboard.php");
    exit(); 
}

$error = false;
$email = $password = $emailError = $passError = "";

if (isset($_POST["login"])) {
    $email = cleanInputs($_POST["email"]);
    $password = cleanInputs($_POST["password"]);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $error = true;
        $emailError = "Please enter a valid email address";
    }

    if (empty($password)) {
        $error = true;
        $passError = "Please enter your password";
    }

    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "SELECT * FROM `users` WHERE `email` = '{$email}' AND `password` = '{$password}'";
        $result = mysqli_query($conn, $sql);
        $person = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);


        if ($count === 1) {
            if ($person["status"] == "admn") {
                $_SESSION["admn"] = $person["id"];
                header("Location: dashboard.php");
                exit(); 
            } else {
                $_SESSION["user"] = $person["id"];
                header("Location: home.php");
                exit(); 
            }
        } else {
            $emailError = "Email or Passwod is incorrect";
            $passError = "Email or Passwod is incorrect";
            
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <img class="logo" src="images/logo.svg" alt="logo">
        <nav class="navLinks">
            <ul>
                <li><p>Only one click to match your pet!<p></li>
            </ul>
        </nav>
        <a href="register.php"><button>Register</button></a>
    </header>
    <div class="container">
        <div class="form">
            <div class="wrapperLogin">
                <h1>WELCOME!</h1>
                <form method="post">
                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email"><i class='bx bxs-envelope'></i>
                        <p class="error"><?= $emailError; ?></p>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="password"><i class='bx bxs-lock-alt'></i>
                        <p class="error"><?= $passError; ?></p>
                    </div>
                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox">Remember Me
                        </label> 
                        <a href="">Forgot Password?</a>
                    </div>
                    <button class="bttn" type="submit" name="login">Login</button>
                    <div class="register-link">
                        <p>Do not have an account? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "./components/footer.php" ?>

</body>
</html>