<?php
session_start();
require_once "db_connect.php";
require_once "file_upload.php";

if (!isset($_SESSION["user"]) && !isset($_SESSION["admn"])) {
    header("Location: login.php");
    exit();
}

$id = isset($_SESSION["admn"]) ? $_SESSION["admn"] : $_SESSION["user"];

$backLink = isset($_SESSION["admn"]) ? "dashboard.php" : "home.php";

$sql = "SELECT * FROM `users` WHERE `id` = {$id}";
$result = mysqli_query($conn, $sql);
$person = mysqli_fetch_assoc($result);


$error = false;
$fnameError = $lnameError = $emailError = $addressError = $phoneError = $dateError = "";

if (isset($_POST["update"])) {
    $first_name = cleanInputs($_POST["first_name"]);
    $last_name = cleanInputs($_POST["last_name"]);
    $email = cleanInputs($_POST["email"]);
    $date_of_birth = cleanInputs($_POST["date_of_birth"]);
    $address = cleanInputs($_POST["address"]);
    $phone_number = cleanInputs($_POST["phone_number"]);
    $picture = fileUpload($_FILES["picture"], "user");

    if (empty($first_name)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($first_name) < 3) {
        $error = true;
        $fnameError = "First name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
        $error = true;
        $fnameError = "Fist name must only contain letters and spaces";
    }

    if (empty($last_name)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($last_name) < 3) {
        $error = true;
        $lnameError = "Last name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        $error = true;
        $lnameError = "Last name must only contain letters and spaces";
    }

    if (empty($email)) {
        $error = true;
        $emailError = "Email can't be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    }

    if (empty($address)) {
        $error = true;
        $addressError = "Please, enter your address";
    } elseif (strlen($address) < 3) {
        $error = true;
        $addressError = "Your address must have more characters";
    } elseif (!preg_match('/^[a-zA-Z0-9\s#.,\-\/\'"&]+$/', $address)) {
        $error = true;
        $addressError = "Please, enter a valid address format";
    }

    if (empty($phone_number)) {
        $error = true;
        $phoneError = "Please, enter your phone number";
    } elseif (strlen($phone_number) < 5) {
        $error = true;
        $phoneError = "Your phone number must have at least 5 characters";
    } elseif (!preg_match('/^\+?[0-9() -]{7,}$/', $phone_number)) {
        $error = true;
        $phoneError = "Phone number can olny include digits + and () symbols";
    }

    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Please enter your birth date";
    }

    if (!$error) {

        if ($_FILES["picture"]["error"] == 4) {
            $sql = "UPDATE `users` SET `first_name` = '{$first_name}',`last_name` = '{$last_name}',`email` = '{$email}',`date_of_birth` = '{$date_of_birth}',`address` = '{$address}',`phone_number` = '{$phone_number}' WHERE `id` = {$id}";
        } else {
            $sql = "UPDATE `users` SET `first_name` = '{$first_name}',`last_name` = '{$last_name}',`email` = '{$email}',`date_of_birth` = '{$date_of_birth}',`address` = '{$address}',`phone_number` = '{$phone_number}', `picture` = '{$picture[0]}' WHERE `id` = {$id}";
        }

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert' id='successAlert'>Your profile has been updated!</div>";

            header("refresh: 3; url=$backLink");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once "components/navbar.php" ?>

    <div class="editContainer">
        <div class="form">
            <div class="wrapperEdit">
                <h1>Edit your profile</h1>
                <form method="post" enctype="multipart/form-data">
                    <div class="input-box">
                        <p>First Name</p>
                        <input type="text" placeholder="* First Name" value="<?= $person["first_name"]; ?>" name="first_name">
                        <p class="error"><?= $fnameError; ?></p>
                    </div>
                    <div class="input-box">
                        <p>Last Name</p>
                        <input type="text" placeholder="* Last Name" value="<?= $person["last_name"]; ?>" name="last_name">
                        <p class="error"><?= $lnameError; ?></p>
                    </div>
                    <div class="input-box">
                        <p>Email</p>
                        <input type="email" placeholder="* Email" value="<?= $person["email"]; ?>" name="email">
                        <p class="error"><?= $emailError; ?></p>
                    </div>
                    <div class="input-box">
                        <p>Address</p>
                        <input type="text" placeholder="* Address" value="<?= $person["address"]; ?>" name="address">
                        <p class="error"><?= $addressError; ?></p>
                    </div>
                    <div class="input-box">
                        <p>Phone Number</p>
                        <input type="text" placeholder="* Phone Number" value="<?= $person["phone_number"]; ?>" name="phone_number">
                        <p class="error"><?= $phoneError; ?></p>
                    </div>

                    <div class="input-box-date" style="height: 50px;">
                        <label for="date" class="custom-date" style="padding-left: .5rem;">Date of Birth: </label>
                        <input id="date" type="date" value="<?= $person["date_of_birth"]; ?>" name="date_of_birth">
                        <p class="error"><?= $dateError; ?></p>
                    </div>

                    <div class="input-box" style="height: 50px;">
                        <label for="file-upload" class="input custom-file-upload ">Upload | Update profile picture <i class='bx bx-image-add'></i></label>
                        <input id="file-upload" type="file" name="picture">
                    </div>
                    <div class="bttn-section">
                        <button class="bttn" type="submit" name="update">Update Profile</button>
                        <a href="<?= $backLink; ?>"><button class="bttn" type="button">Go Back</button></a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php require_once "./components/footer.php" ?>


</body>

</html>