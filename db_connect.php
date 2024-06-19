<?php

define("hostName", "localhost:8889");
define("userName", "root");
define("password", "root");
define("dbNAme", "EBEWD2_CR5_animal_adoption_IlianaMarquez");


$conn = mysqli_connect(hostName, userName, password, dbNAme);



if (!$conn) {
    die("Connection failed");
  }




function cleanInputs ($value){
    $data = trim($value);
    $data = strip_tags($value);
    $data = htmlspecialchars($value);

    return $data;
}

