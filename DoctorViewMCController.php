<?php
include_once("MedicalCertificate.php");

class DoctorViewMCController
{
    function viewPatientMC($appointmentDate)
    {
        $patientMC = new MedicalCertificate();
        $result = $patientMC->viewPatientMC($appointmentDate);
        return $result;
    }
}
?>

