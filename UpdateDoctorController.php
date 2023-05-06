<?php
include_once("DoctorDetails.php");
include_once("medicalField.php");

class UpdateDoctorController
{
    function updateDoctor($img,$userID,$name,$education,$field,$position,$description)
    {
        $DoctorDetails = new DoctorDetails();
        $validation = $DoctorDetails->updateDoctor($img,$userID,$name,$education,$field,$position,$description);
        if ($validation == true) 
        {
            return success_alert("Doctor profile successfully updated!");
        } 
        else 
        {
            return failure_alert("Unable to update the doctor profile.");
        }
    }

    function getDoctorMedField ()
    {
        $doctorArr = array();  
        $doctor = new medicalField();
        $doctorArr = $doctor->getAllArrOfMedField();
        return $doctorArr;
    }
}
