<?php
session_start();

require_once "db_connect.php";
require_once "file_upload.php";

if (isset($_SESSION["admn"])) {
    header("Location: home.php");
    exit();
}

if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
    exit();
}

$error = false;
$first_name = $last_name = $email = $password = $address = $phone_number = $date_of_birth = "";
$fnameError = $lnameError = $emailError = $passError = $addressError = $phoneError = $dateError = "";

if (isset($_POST["register"])) {
    $first_name = cleanInputs($_POST['first_name']);
    $last_name = cleanInputs($_POST['last_name']);
    $email = cleanInputs($_POST['email']);
    $password = cleanInputs($_POST['password']);
    $date_of_birth = cleanInputs($_POST['date_of_birth']);
    $address = cleanInputs($_POST['address']);
    $phone_number = cleanInputs($_POST['phone_number']);
    $picture = fileUpload($_FILES['picture'], "user");

    // var_dump($first_name);
    // exit(); it worked!
    if (empty($first_name)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($first_name) < 3) {
        $error = true;
        $fnameError = "First name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
        #php documentation preg-match.php regex quick reference
        $error = true;
        $fnameError = "First name must only contain letters and spaces";
    }

    if (empty($last_name)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($last_name) < 3) {
        $error = true;
        $lnameError = "Last name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        #php documentation preg-match.php regex quick reference
        $error = true;
        $lnameError = "Last name must only contain letters and spaces";
    }

    if (empty($email)) {
        $error = true;
        $emailError = "Email can't be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        $query = "SELECT * FROM `users` WHERE `email` = '{$email}'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Email address already exist";
        }
    }

    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passError = "Password must have at least 6 charachters";
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

        $password = hash("sha256", $password);

        $sql = "INSERT INTO `users` (`first_name`,`last_name`,`email`,`password`,`date_of_birth`,`address`,`phone_number`,`picture`) VALUES ('{$first_name}','{$last_name}','{$email}','{$password}','{$date_of_birth}','{$address}','{$phone_number}','{$picture[0]}')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<div class='alert' id='successAlert'>New account was created! {$picture[1]}</div>";

            $first_name = $last_name = $email = $password = $address = $phone_number = $date_of_birth = $picture = "";

            header("refresh: 3; url=login.php");
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
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
</head>

<body>
    <header>
        <img class="logo" src="images/logo.svg" alt="logo">
        <nav class="navLinks">
            <ul>
                <li><p>Get ready to match your pet!</p></li>
            </ul>
        </nav>
        <a href="login.php"><button>Login</button></a>
    </header>
    <div class="container">
        <div class="form">
            <div class="wrapperRegister">
                <h1>Nice to have you here!</h1>
                <form method="post" enctype="multipart/form-data">
                    <div class="input-grid">
                        <div class="input-box">
                            <input type="text" placeholder="* First Name" name="first_name"><i class='bx bxs-user'></i>
                            <p class="error"><?= $fnameError; ?></p>
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="* Last Name" name="last_name"><i class='bx bxs-user'></i>
                            <p class="error"><?= $lnameError; ?></p>
                        </div>
                        <div class="input-box">
                            <input type="email" placeholder="* Email" name="email"><i class='bx bxs-envelope'></i>
                            <p class="error"><?= $emailError; ?></p>
                        </div>
                        <div class="input-box">
                            <input type="password" placeholder="* Password" name="password"><i class='bx bxs-lock-alt'></i>
                            <p class="error"><?= $passError; ?></p>
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="* Address [ Str , Nr , City , ZIP ]" name="address"><i class='bx bxs-map'></i>
                            <p class="error"><?= $addressError; ?></p>
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="* Phone Number" name="phone_number"><i class='bx bxs-phone'></i></i>
                            <p class="error"><?= $phoneError; ?></p>
                        </div>
                        <div class="input-box-date">
                            <label for="date" class="custom-date">* Date of Birth: </label>
                            <input id="date" type="date" name="date_of_birth">
                            <p class="error"><?= $dateError; ?></p>
                        </div>
                        <div class="input-box">
                            <label for="file-upload" class="input custom-file-upload ">Upload profile picture <i class='bx bx-image-add'></i></label>
                            <input id="file-upload" type="file" name="picture">
                        </div>
                    </div>
                    <div class="bttn-section">
                        <button class="bttn" type="submit" name="register">Register</button>
                    </div>
                    <div class="register-link">
                        <p>Already registered? <a href="login.php">Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "./components/footer.php" ?>


    <script>
        document.getElementById('file-upload').addEventListener('change', function (){
           let fileName = this.files[0].name; //get the name of the selcted file
           let label = document.querySelector('label[for="file-upload"]'); // Get the label associated with the file input
           label.innerHTML = fileName + '<i class="bx bx-image-add"></i>'; // Update the label text with the file name and icon
            label.classList.add('file-chosen'); // Add the class to change the text color to white
        }); 
        // document.getElementById('date').addEventListener('change', funtion(){
        //     let uDate = this.date

        // });
        //     console.log (fileName);
        // });
    </script>
</body>

</html>