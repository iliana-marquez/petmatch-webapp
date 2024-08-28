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


$sqlAdoptions = "SELECT adoptions.*, users.picture AS user_picture, pets.picture AS pet_picture
                 FROM `adoptions` 
                 JOIN `users` ON adoptions.fk_user = users.id 
                 JOIN `pets` ON adoptions.fk_pet = pets.id";
$aResults = mysqli_query($conn, $sqlAdoptions);
$layout = "";


if (mysqli_num_rows($aResults) == 0) {
    $layout = "No pets found";
} else {
    $rows = mysqli_fetch_all($aResults, MYSQLI_ASSOC);
    foreach ($rows as $adoption) {
        $layout .= "
            <tr>
                <td><img src='./images/{$adoption["user_picture"]}' style='height: 8vh;' alt=''></td>
                <td>{$adoption["adoption_date"]}</td>
                <td>{$adoption["adoption_location"]}</td>
                <td><img src='./images/{$adoption["pet_picture"]}' style='height: 8vh;' alt=''></td>
                
            </tr>   
        ";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoptions</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
</head>

<body>
    <?php require_once "components/navbar.php" ?>

    <div class="userContainer">

        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>USER</th>
                    <th>DATE</th>
                    <th>LOCATION</th>
                    <th>PET</th>
                </tr>
            </thead>

            <tbody>
                <?= $layout ?>
            </tbody>

        </table>
    </div>

    <?php require_once "./components/footer.php" ?>


</body>

</html>