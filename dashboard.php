<?php
session_start();
require_once "db_connect.php"; 

if (!isset($_SESSION["admn"]) && !isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
}

$id = $_SESSION["admn"]; 
$sql = "SELECT * FROM `users` WHERE `id` = {$id}";
$result = mysqli_query($conn, $sql);
$person = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
</head>

<body>
    <?php require_once "components/navbar.php" ?>

    <div class="container">
        <div class="form">
            <div class="wrapperRegister">
                <h2>Please select the desired records to work on</h2>
                <div class="bttn-section">
                    <a href="pets.php"><button class="bttn" type="button">Pets</button></a>                    <button class="bttn" type="submit">Users</button>
                    <button class="bttn" type="submit">Adoptions</button>
                </div>
            </div>
        </div>

    </div>

    <?php require_once "./components/footer.php" ?>


</body>

</html>