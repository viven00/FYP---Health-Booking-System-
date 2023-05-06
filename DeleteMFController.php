<?php
include_once("medicalField.php");

class DeleteMFController
{
    function deleteMF($medicalFieldID)
    {
        $currAppt = new medicalField();

        $validation = $currAppt->deleteMF($medicalFieldID);
        if ($validation == true) 
        {
            return success_alert("The medical field has been deleted!");
        } 
        else 
        {
            return failure_alert("Sorry, the medical field has not been deleted.");
        }
    }


}
