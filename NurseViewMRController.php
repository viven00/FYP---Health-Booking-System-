<?php
include_once("MedicalRecord.php");

class NurseViewMRController
{
    function viewPatientMR($appointmentDate)
    {
        $NurseMR = new medicalrecords();
        $result = $NurseMR-> viewPatientMR($appointmentDate);
        return $result;
    }

}
?>


