<?php
include_once("HEM.php"); 
class DeleteHEMController
{
    function deleteHEM($materialID)
    {
        $HEM = new HEM();

        $validation = $HEM->deleteHEM($materialID);
        if ($validation == true) 
        {
            return success_alert("Health Education Material successfully deleted!");
        } 
        else 
        {
            return failure_alert("Unable to delete the Health Education Material.");
        }
    }
}
