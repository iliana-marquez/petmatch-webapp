<?php

function fileUpload($picture, $source = "user"){ 

   
    if ($picture["error"] == 4) {  
        $pictureName = "avatar.png";
        if ($source == "pet") { 
            $pictureName = "pet.png";
        }
        $message = "No picture has been chosen, but you can upload one later";
    } else {
        $checkIfImage = getimagesize($picture["tmp_name"]);
        $message = $checkIfImage ? "Ok" : "Invalid file type, only .jpg, .jpeg or .png allowed";
    }

    if ($message == "Ok") {
        $ext = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION)); 
        $pictureName = uniqid("") . "." . $ext; 
        $destination = "images/{$pictureName}";
        move_uploaded_file($picture["tmp_name"], $destination);
    }

    return [$pictureName, $message];
}
