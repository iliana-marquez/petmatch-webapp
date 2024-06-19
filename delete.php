<?php
session_start();
require_once "db_connect.php";


if (!isset($_SESSION["user"]) && !isset($_SESSION["admn"])) {
    header("Location: login.php");
    exit();
}

if(isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
}


if(isset($_GET["id"])){
    $id = $_GET["id"]; 

    $sqlSelect = "SELECT `picture` FROM `pets` WHERE id = {$id}";

    $result = mysqli_query($conn, $sqlSelect);
    $pet = mysqli_fetch_assoc($result);
    
    if ($pet["picture"] != "pet.png"){
        unlink("images/{$pet["picture"]}"); 
    }

    $sql= "DELETE FROM `pets` WHERE id = {$id}";
    
    mysqli_query($conn, $sql);
    header("Location: pets.php"); 

}