<?php

define("hostName", "173.212.235.205");
define("userName", "ilianacodefactor_ilianacodefacto");
define("password", "FullyStacked!");
define("dbNAme", "ilianacodefactor_petAdopt");


$conn = mysqli_connect(hostName, userName, password, dbNAme);

$conn->set_charset("utf8mb4");


if (!$conn) {
    die("Connection failed");
  }




function cleanInputs ($value){
    $data = trim($value);
    $data = strip_tags($value);
    $data = htmlspecialchars($value);

    return $data;
}

