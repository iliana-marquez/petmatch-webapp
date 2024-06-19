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

$adoption_location = $locationError = "";
$error = false;


if (isset($_GET['id'])) {
    $petId = $_GET['id'];
    $pSql = "SELECT * FROM `pets` WHERE `id` = {$petId}";
    $pResult = mysqli_query($conn, $pSql);
    $pet = mysqli_fetch_assoc($pResult);




    if (isset($_POST["adopt"])) {
        $fk_user = $id;
        $fk_pet = $petId;
        $adoption_date = date('Y-m-d');
        $adoption_location = cleanInputs($_POST["adoption_location"]);

        if (empty($adoption_location)) {
            $error = true;
            $locationError = "Please enter the adoption's location";
        } elseif (strlen($adoption_location) < 3) {
            $error = true;
            $locationError = "The adoption's location must have at least 3 characters";
        } elseif (!preg_match("/^[A-Za-z0-9,.\s]+$/", $adoption_location)) {
            $error = true;
            $locationError = "Please enter a valid location format";
        }

        $adoptSql= "INSERT INTO `adoptions`(`fk_user`, `fk_pet`, `adoption_date`, `adoption_location`) VALUES ('{$fk_user}','{$fk_pet}','{$adoption_date}','{$adoption_location}')";

        if(mysqli_query($conn, $adoptSql)){
            echo "<div class='alert' id='successAlert'><h1>Congratulations, {$person['first_name']}! You just adopted {$pet['pet_name']}!</h1></div>";

            $adoption_location = "";
            
            header("refresh: 1; url=home.php");
        } else {
            echo "<div class='alert' id='errorAlert'>Something went wrong. Please try again later</div>";
        }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php require_once "./components/navbar.php" ?>

    <div class="editContainer">
        <form method="POST">
            <div class="wrapperEdit">
                <h1 style="text-align: center;">Just one input away for adopting!</h1>
                <br>
                <h4 style="text-align: center;">please fill out the location and submit</h4>
                <br>
                <div class="input-box">
                    <input type="text" id="adoption_location" name="adoption_location" placeholder="Enter adoption location">
                    <p class="error"><?= $locationError; ?></p>
                </div>
                <div class="bttn-section">
                    <button type="submit" name="adopt">Submit</button>
                </div>

            </div>
        </form>
    </div>

    <footer>
        <div class="footerNav">
            <a href="#">About</a>
            <a href="#">FAQ</a>
            <a href="#">Privacy</a>
            <a href="#">Contact</a>
        </div>
    </footer>
</body>

</html>