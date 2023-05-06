<?php
include_once("DoctorDetails.php");

class DeleteDoctorController
{
    function deleteDoctor($userID)
    {
        $doctor = new DoctorDetails();

        $validation = $doctor->deleteDoctor($userID);
        if ($validation == true) 
        {
            return success_alert("The doctor profile has been deleted!");
        } 
        else 
        {
            return failure_alert("The doctor profile has not been deleted.");
        }
    }


}
