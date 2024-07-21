<?php

require_once "db_connect.php";

$search = $_GET["search"];

$sql = "SELECT * FROM pets WHERE breed LIKE '%{$search}%' OR pet_size LIKE '%{$search}%' OR pet_gender LIKE '%{$search}%'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0) {
    echo "<h5 style='color: white'>Sorry, no results found!</h5>";
} else {
    $pets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($pets as $pet) {
        echo "
        <div class='card' style='background-image: url(\"images/{$pet["picture"]}\");'>
        <div class='cardTitle'>
            <h1>{$pet["pet_name"]}</h1>
        </div>
        <div class='cardContent'>
            <p>&#10003; <span>{$pet["breed"]} (<span>{$pet["pet_gender"]}</span>)</span></p>
            <p>&#10003; <span><span>{$pet["pet_age"]} </span>years old</span></p>
            <p>&#10003; <span>{$pet["pet_size"]}</span></p>
        </div>
        <div class='cardBotones'>
            <button><a href='pet_details.php?id={$pet["id"]}'><i class='bx bxs-hand-up'></i> Details</a></button>
            <a href='edit_pet.php?id={$pet["id"]}'><button>Update</button></a>
            <a href='delete.php?id={$pet["id"]}'><button><i class='bx bxs-trash'></i> Delete</button></a>
        </div>
        </div>";
    }
}