<?php
session_start();

if(isset($_GET["logout"])){

    unset($_SESSION["user"]);
    unset($_SESSION["admn"]);
    session_unset(); 
    session_destroy(); 

    header("Location: login.php"); 
}


var_dump($_SESSION["user"] || $_SESSION["admn"]);
exit();