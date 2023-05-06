<?php
include_once("HEM.php");
class UpdateHEMController
{
    function updateHem($img, $materialID, $title, $descriptions, $lastUpdate)
    {
        $hem = new HEM();
        $validation = $hem->updateHem($img, $materialID, $title, $descriptions, $lastUpdate);
        if ($validation == true) 
        {
            return success_alert("Health Education Material successfully updated!");
        } 
        else 
        {
            return failure_alert("Unable to update the Health Education Material.");
        }
    }
}
