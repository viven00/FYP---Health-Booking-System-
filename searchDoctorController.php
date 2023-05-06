<?php
include_once("DoctorDetails.php");// include user entity to call function

class searchDoctorController
{
    
    public function getAllDoctor($medicalField, $doctor )
    {
        $doc = new DoctorDetails();
        $result = $doc-> getAllDoctor($medicalField, $doctor);
        return $result;
    }


}
?>


