<?php
include_once("MedicalRecord.php");

class DoctorViewMRController
{
    function viewPatientMR($appointmentDate)
    {
        $DocMR = new medicalrecords();
        $result = $DocMR-> viewPatientMR($appointmentDate);
        return $result;
    }

    function getMR($appointmentID)
    {
        $DocMR = new medicalrecords();
        $result = $DocMR-> getMR($appointmentID);
        return $result;
    }
}
?>


