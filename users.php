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


$sqlUsers = "SELECT * FROM `users`";
$uResults = mysqli_query($conn, $sqlUsers);
$layout = "";


if (mysqli_num_rows($uResults) == 0) {
    $layout = "No pets found";
} else {
    $rows = mysqli_fetch_all($uResults, MYSQLI_ASSOC);
    foreach ($rows as $user) {
        $layout .= "
            <tr>
                <td><img src='./images/{$user["picture"]}' style='height: 8vh;' alt=''></td>
                <td>{$user["id"]}</td>
                <td>{$user["first_name"]}</td>
                <td>{$user["last_name"]}</td>
                <td>{$user["email"]}</td>
                <td>{$user["phone_number"]}</td>
                <td>{$user["status"]}</td>
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
    <title>Users</title>
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
                    <th>Profile</th>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>SURNAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>STATUS</th>
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