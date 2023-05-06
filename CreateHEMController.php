<?php
include_once("HEM.php"); 
include_once("User.php"); 

class CreateHemController
{
    function CreateHEM($imageurl, $title, $keyword, $descriptions, $publishDate, $lastUpdate, $author) {
        $hem = new Hem();
        $validation = $hem->CreateHEM($imageurl, $title, $keyword, $descriptions, $publishDate, $lastUpdate, $author);
        if ($validation == TRUE) {
            return success_alert("Health Education Material successfully published!");
        }
        else {
            return failure_alert("Unable to publish material.");
        }
    }

    public function getName($userID)
    {   
        $user = new user();
        $result = $user->getName($userID);
        return $result;
    }

}
?>