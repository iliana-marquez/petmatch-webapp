<?php
session_start();
require_once "db_connect.php";
require_once "file_upload.php";

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


$idPet = $_GET["id"];

$sql = "SELECT * FROM `pets` WHERE `id` = {$idPet}";
$pResult = mysqli_query($conn, $sql);
$pet = mysqli_fetch_assoc($pResult);

$error = false;
$pnameError = $breedError = $ageError = $sizeError = $locationError = $genderError = $vaccinesError = $statusError = $descriptionError = "";


if (isset($_POST["update"])){
    $pname = cleanInputs($_POST["pname"]);
    $breed = cleanInputs($_POST["breed"]);
    $age = cleanInputs($_POST["age"]);
    $size = cleanInputs($_POST["size"]);
    $gender = cleanInputs($_POST["gender"]);
    $vaccines = cleanInputs($_POST["vaccines"]);
    $location = cleanInputs($_POST["location"]);
    $status = cleanInputs($_POST["status"]);
    $description = cleanInputs($_POST["description"]);
    $picture = fileUpload($_FILES["picture"], "pet");



    if (empty($pname)) {
        $error = true;
        $pnameError = "Please enter the pet name";
    } elseif (strlen($pname) < 3) {
        $error = true;
        $pnameError = "The pet's name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $pname)) {
        $error = true;
        $pnameError = "The pet's name must have only letters & spaces";
    }

    if (empty($breed)) {
        $error = true;
        $breedError = "Breed must be given";
    } elseif (strlen($breed) < 3) {
        $error = true;
        $breedError = "The pet's name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $breed)) {
        $error = true;
        $breedError = "The pet's name must have only letters & spaces";
    }

    if (empty($age)) {
        $error = true;
        $ageError = "Please enter the pet's age";
    } elseif (!is_numeric($age) || $age < 0 || $age > 100) {
        $error = true;
        $ageError = "The age must be a number between 0 and 10";
    }

    if (empty($location)) {
        $error = true;
        $locationError = "A location must be given";
    } elseif (strlen($location) < 3) {
        $error = true;
        $locationError = "The pet's location must have at least 3 characters";
    } 

    if ($size === "null") {
        $error = true;
        $sizeError = "Size must be selected";
    } elseif (strlen($size) < 3) {
        $error = true;
        $sizeError = "The pet's size must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $size)) {
        $error = true;
        $sizeError = "The pet's size must have only letters & spaces";
    }

    if ($gender === "null") {
        $error = true;
        $genderError = "Gender must be selected";
    } elseif (strlen($gender) < 3) {
        $error = true;
        $genderError = "The pet's gender must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $gender)) {
        $error = true;
        $genderError = "The pet's gender must have only letters & spaces";
    }

    if ($vaccines === "null") {
        $error = true;
        $vaccinesError = "Please select an option";
    } 

    if ($status === "null") {
        $error = true;
        $statusError = "Please select an option";
    } 

    if (empty($description)) {
        $error = true;
        $descriptionError = "Description must be provided";
    } elseif (strlen($description) < 10) {
        $error = true;
        $descriptionError = "The pet's description must have at least 10 characters";
    }

    if (!$error) {


        
        
        if($_FILES["picture"]["error"] ==4 ){
            $sql = "UPDATE `pets` SET `pet_name` = '{$pname}', `breed` = '{$breed}', `pet_age` = '{$age}', `pet_size` = '{$size}', `pet_gender` = '{$gender}', `vaccines` = '{$vaccines}', `pet_location` =  '{$location}', `status` = '{$status}', `pet_description` = '{$description}' WHERE `id` = {$idPet}"; 
        }else{
            $sql = "UPDATE `pets` SET `pet_name` = '{$pname}', `breed` = '{$breed}', `pet_age` = '{$age}', `pet_size` = '{$size}', `pet_gender` = '{$gender}', `vaccines` = '{$vaccines}', `pet_location` =  '{$location}', `status` = '{$status}', `pet_description` = '{$description}', `picture` = '{$picture[0]}' WHERE `id` = {$idPet}"; 
        }
       
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert' id='successAlert'>Pet entry successfully updated! {$picture[1]}</div>";
            header("refresh: 3; url=pets.php");
        } else {
            echo "<div class='alert' id='errorAlert'>Something went wrong trying to create a new pet entry. Please try again later</div>";
        }
    }
}
    






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet Entry</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php require_once "./components/navbar.php" ?>
    <div class="editContainer">
        <div class="form">
            <div class="wrapperRegister">
                <h1>Edit <span><?= $pet["pet_name"] ?></span>'s Info</h1>
                <form method="post" enctype="multipart/form-data">
                    <div class="input-grid">
                        <div class="input-box">
                            <input type="text" placeholder="* Pet's Name" name="pname" value="<?= $pet["pet_name"]; ?>"><i class='bx bxs-dog'></i>
                            <p class="error"> <?= $pnameError; ?></p>
                        </div>
                        <div class="input-box">

                            <input type="text" placeholder="* Breed" name="breed" value="<?= $pet["breed"]; ?>"><i class='bx bxl-baidu'></i>
                            <p class="error"><?= $breedError; ?></p>
                        </div>
                        <div class="input-box">
                            <input type="number" placeholder="* Age (current: <?= $pet["pet_age"]; ?>)" name="age"><i class='bx bxs-calendar-heart'></i>
                            <p class="error"><?= $ageError; ?></p>
                        </div>
                        <div class="input-box">

                            <input type="text" placeholder="* Location" name="location" value="<?= $pet["pet_location"]; ?>"><i class='bx bxs-map'></i></i>
                            <p class="error"><?= $locationError; ?></p>
                        </div>

                        <div class="input-box">
                            <select name="size">
                                <option value="null">Select a size (current: <?= $pet["pet_size"]; ?>) </option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Big">Big</option>
                            </select>
                            <i class='bx bxs-chevron-down'></i>
                            <p class="error"><?= $sizeError; ?></p>
                        </div>
                        <div class="input-box">
                            <select name="gender">
                                <option value="null">Select gender (current: <?= $pet["pet_gender"] ?>)</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                            <i class='bx bxs-chevron-down'></i>
                            <p class="error"><?= $genderError; ?></p>
                        </div>

                        <div class="input-box">
                            <select name="vaccines">
                                <option value="null">Vaccinated? (current: <?= $pet["vaccines"] == 1 ? "Yes" : "No" ?>)</option>                               
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <i class='bx bxs-chevron-down'></i>
                            <p class="error"><?= $vaccinesError; ?></p>
                        </div>

                        <div class="input-box">
                            <select name="status">
                                <option value="null">Adopted? (current: <?= $pet["status"] == 1 ? "Yes" : "No" ?>)</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <i class='bx bxs-chevron-down'></i>
                            <p class="error"><?= $statusError; ?></p>
                        </div>

                        <div class="input-box">

                            <input type="text" placeholder="* Description" name="description" value="<?= $pet["pet_description"]; ?>">
                            <p class="error"><?= $descriptionError; ?></p>
                        </div>
                        <div class="input-box">
                            <input id="file-upload" type="file" name="picture">
                            <label for="file-upload" class="input custom-file-upload"><i class='bx bx-image-add'></i></label>
                        </div>
                    </div>
                    <button class="bttn" type="submit" name="update">Update Entry</button>
                    <a href="pets.php"><button class="bttn" type="button">Go Back</button></a>
                </form>
            </div>
        </div>
    </div>

    <?php require_once "./components/footer.php" ?>
    

</body>

</html>