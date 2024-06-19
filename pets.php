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

$sqlPets = "SELECT * FROM `pets`";
$pResults = mysqli_query($conn, $sqlPets);
$layout = "";

if (mysqli_num_rows($pResults) == 0) {
    $layout = "No pets found";

}else{
    $rows = mysqli_fetch_all($pResults, MYSQLI_ASSOC);
    foreach ($rows as $pet) {
        $layout .= "
        <div class='card' style='background-image: url(\"images/{$pet["picture"]}\");'>
        <div class='cardTitle'>
            <h1>{$pet["pet_name"]}</h1>
        </div>
        <div class='cardContent'>
            <p>&#10003; <span>{$pet["breed"]} (<span>{$pet["pet_gender"]}</span>)</span></p>
            <p>&#10003; <span><span>{$pet["pet_age"]} </span>years old</span></p>
            <p>&#10003; <span>{$pet["pet_size"]}</span></p>
        </div>
        <div class='cardBotones'>
            <button><a href='pet_details.php?id={$pet["id"]}'><i class='bx bxs-hand-up'></i> Details</a></button>
            <a href='edit_pet.php?id={$pet["id"]}'><button>Update</button></a>
            <a href='delete.php?id={$pet["id"]}'><button><i class='bx bxs-trash'></i> Delete</button></a>
        </div>
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php require_once "./components/navbar.php" ?>

    <div class="grid">
        <?= $layout ?>     
    </div>

    <footer>
        <div class="footerNav">
            <a href="#">Back to the Top</a>
            <a href="#">Edit my Profile</a>
            <a href="#">FAQ</a>
            <a href="#">Contact</a>
        </div>
    </footer>

</body>

</html>