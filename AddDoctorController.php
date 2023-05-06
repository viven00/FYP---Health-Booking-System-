<?php
include_once("DoctorDetails.php");
include_once("medicalField.php");
class AddDoctorController
{

    function getDocID ()
    {
        $doctorArr = array();  
        $doctor = new DoctorDetails();
        $doctorArr = $doctor->getDocID();
        return $doctorArr;
    }

    function getMedField ()
    {
        $doctorArr = array();  
        $doctor = new medicalField();
        $doctorArr = $doctor->getAllMedField();
        return $doctorArr;
    }
    

    function addDoctor($img,$userID,$name,$education,$field,$position,$description)
    {
        $doctor = new DoctorDetails();
        $checkUsername = $doctor->checkDuplicateUsername($name);
        
        if ($checkUsername == true)
        {
            $validation = $doctor->addDoctor($img,$userID,$name,$education,$field,$position,$description);
            if ($validation == true)
            {
                return success_alert("New doctor profile is successfully added!");
            }
            else
            {
                return failure_alert("Unable to add doctor profile.");
            }
        }
        else
        {
            return failure_alert("The doctor profile already exists. Please add another doctor profile.");
        }
    }
}