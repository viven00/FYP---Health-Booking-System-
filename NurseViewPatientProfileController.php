<?php
include_once("MedicalRecord.php");

class NurseViewPatientProfileController
{
    function viewPatient($name)
    {
        $Patient = new medicalrecords();
        $result = $Patient-> viewPatient($name);
        return $result;
    }
}
?>


