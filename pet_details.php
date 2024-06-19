<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION["user"]) && !isset($_SESSION["admn"])) {
    header("Location: login.php");
    exit();
}

$id = isset($_SESSION["admn"]) ? $_SESSION["admn"] : $_SESSION["user"];

$sql = "SELECT * FROM `users` WHERE `id` = {$id}";
$result = mysqli_query($conn, $sql);
$person = mysqli_fetch_assoc($result);

if(isset($_GET["id"])){
    $petId = $_GET["id"];

    $pSql = "SELECT * FROM `pets` WHERE `id` = {$petId}";
    $pResult = mysqli_query($conn, $pSql);
    $pet = mysqli_fetch_assoc($pResult);

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Details</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php require_once "./components/navbar.php" ?>

    <div class="details" style="background-image: url('images/<?= $pet["picture"] ?>')">
      
         <div class="details-content">
            <p><i class='bx bxl-baidu'></i> <span><?= $pet["breed"] ?> (<span>female</span>)</span></p>
            <p><i class='bx bx-calendar-heart' ></i> <span><span><?= $pet["pet_age"] ?> years old</span></p>
            <p><i class='bx bxs-injection'></i> <span><?=  $pet["vaccines"] == 1? "Vaccinated" : "Not vaccinated"; ?></span></p>
            <p><i class='bx bxs-map'></i> <span><?= $pet["pet_location"] ?></p>
            <p><i class='bx bx-home-heart'></i> <span><?=  $pet["status"] == 1? "Adopted" : "Not adopted"; ?></span>
            <p><i class='bx bx-vertical-center'></i> <span><?= $pet["pet_size"] ?></span>

        </div>

        <div class="pet-name">
        <h1><?= $pet["pet_name"] ?></h1>
        </div>
        <div class="details-content">
        <p><span><?= $pet["pet_description"] ?></span></p>
        </div>
       
        <?php if (isset($_SESSION["user"])): ?>
        <div class="cardBotones">
            <a href='adoption.php?id=<?=$pet["id"]?>'><button>Adopt me! <i class='bx bxs-heart'></i></button>
            <a href="home.php"><button>Go back</button></a>
        </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["admn"])): ?>
            <div class='cardBotones'>
            <a href='edit_pet.php?id=<?=$pet["id"]?>'><button>Update</button></a>
            <a href='delete.php?id=<?=$pet["id"]?>'><button><i class='bx bxs-trash'></i> Delete</button></a>
        </div>
        <?php endif; ?>

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