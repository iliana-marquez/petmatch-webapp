<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Match</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
</head>

<body>
    <header>
        <img class="logo" src="images/logo.svg" alt="logo">
        <nav class="navLinks">
            <ul>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
        <a class="" href="login.php"><button>Match your pet</button></a>
    </header>
    <div class="container">
        <h1>Get ready to meet your matching Pawl!</h1>
        <a href="login.php"><button>Find me!</button></a>
        
    </div>
    <?php require_once "./components/footer.php" ?>
</body>
</html>