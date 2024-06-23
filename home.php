<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION["user"]) && !isset($_SESSION["admn"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION["admn"])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_SESSION["user"];
$sql = "SELECT * FROM `users` WHERE `id` = {$id}";
$result = mysqli_query($conn, $sql);
$person = mysqli_fetch_assoc($result);

$layout = "";

$sqlPets = "SELECT * FROM `pets` WHERE `status` = 0";

if (isset($_GET['age'])) {
    if ($_GET['age'] === 'baby') {
        $sqlPets = "SELECT * FROM `pets` WHERE `pet_age` BETWEEN 0 AND 3 AND `status` = 0";
    } elseif ($_GET['age'] === 'junior') {
        $sqlPets = "SELECT * FROM `pets` WHERE `pet_age` BETWEEN 4 AND 7 AND `status` = 0";
    } elseif ($_GET['age'] === 'senior') {
        $sqlPets = "SELECT * FROM `pets` WHERE `pet_age` >= 8 AND `status` = 0";
    }
}

$pResults = mysqli_query($conn, $sqlPets);

if (mysqli_num_rows($pResults) == 0) {
    $layout = "No pets found";
} else {
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
            <button><a href='pet_details.php?id={$pet["id"]}'>+ about me...</a></button>
            <button><a href='adoption.php?id={$pet["id"]}'>take me home!</a></button>
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
    <title>My Pet Match</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php require_once "./components/navbar.php" ?>

    <div class="searchWrapper" style="gap:1rem">

        <div class="buttons">
            <a href="home.php?age=baby"><button type="button">Baby Pets</button></a>
            <a href="home.php?age=junior"><button type="button">Junior Pets</button></a>
            <a href="home.php?age=senior"><button type="button">Senior Pets</button></a>
            <a href="home.php"><button type="button">All</button></a>
        </div>

        <form method="post">
            <div class="search-input">
                <input type="text" id="search" placeholder="Search for...">
                <button type="submit"><i class='bx bxs-search-alt-2'></i></button>
            </div>
        </form>

    </div>

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