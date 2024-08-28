<?php

require_once "db_connect.php";

$error = false;
$fname = $lname = $email = $subject = $message = "";
$fnameError = $lnameError = $emailError = $messageError = $subjectError = "";

if($_SERVER['REQUEST_METHOD'] == "POST" ){
    $fname = cleanInputs($_POST['first_name']);
    $lname = cleanInputs($_POST['last_name']);
    $email = cleanInputs($_POST['email']);
    $subject = cleanInputs($_POST['subject']);
    $message = cleanInputs($_POST['message']);

    // var_dump($fname, $lname, $email, $subject, $message);
    // exit(); ONLY TO CHECK THAT THE INFO WAS CORRECTLY TAKEN FROM THE POST METHOD
    
    if (empty($fname)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($fname) < 3) {
        $error = true;
        $fnameError = "First name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        #php documentation preg-match.php regex quick reference
        $error = true;
        $fnameError = "First name must only contain letters and spaces";
    }
    if (empty($lname)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Last name must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        #php documentation preg-match.php regex quick reference
        $error = true;
        $lnameError = "Last name must only contain letters and spaces";
    }

    if (empty($subject)) {
        $error = true;
        $subjectError = "Please, enter your subject";
    } elseif (strlen($subject) < 3) {
        $error = true;
        $subjectError = "The subject must have at least 3 characters";
    } 

    if (empty($email)) {
        $error = true;
        $emailError = "Email can't be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } 

    if (empty($message)) {
        $error = true;
        $messageError = "Please, enter your message";
    } elseif (strlen($message) < 3) {
        $error = true;
        $messageError = "Your message must have at least 3 characters";
    } 


    $headers = "From: " . $fname . " " . $lname . " <" . $email . ">";
    $myEmail = "iliana.marquez@hotmail.com";
    
    if (mail($myEmail, $subject, $message, $headers)) {
        echo "Email sent successfully!";
      
    } else {
        echo "Failed to send email.";
    }



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    
</head>
<body>
<div class="container" style="height: 100vh">
        <div class="form">
            <div class="wrapperEdit">
                <h1>Send us an email!</h1>
                <form method="post">
                <div class="input-box">
                        <p>First Name</p>
                        <input type="text" placeholder="* First Name"  name="first_name">
                        <p class="error"><?= $fnameError; ?></p>
                    </div>
                    <div class="input-box">
                        <p>Last Name</p>
                        <input type="text" placeholder="* Last Name" name="last_name">
                        <p class="error"><?= $lnameError; ?></p>
                    </div>
                    <div class="input-box">
                        <p>Email</p>
                        <input type="email" placeholder="* Email" name="email">
                        <p class="error"><?= $emailError; ?></p>
                    </div>
                    <div class="input-box">
                        <p>Subject</p>
                        <input type="text" placeholder="* Subject" name="subject">
                        <p class="error"><?= $subjectError; ?></p>
                    </div>
                    <div class="input-box" style="margin-bottom: 3rem">
                        <label for="message">Your message</label>
                        <textarea type="text" id="message" placeholder="* write your message" name="message"></textarea>
                        <p class="error"><?= $messageError; ?></p>
                    </div>
                    <button class="bttn" type="submit" name="send">Send</button>
                </form>
                <a href='pets.php'><button class="bttn">Go back</button></a>
            </div>
        </div>
    </div>

    

</body>
</html>