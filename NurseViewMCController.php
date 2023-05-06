<?php
include_once("MedicalCertificate.php");

class NurseViewMCController
{
    function viewPatientMC($appointmentDate)
    {
        $DocMC = new medicalcertificate();
        $result = $DocMC-> viewPatientMC($appointmentDate);
        return $result;
    }

}
?>

