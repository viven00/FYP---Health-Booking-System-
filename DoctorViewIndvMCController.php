<?php
include_once("MedicalCertificate.php");

class DoctorViewIndvMCController
{
    function viewIndvMC($medicalcertificateID)
    {
        $MC= new MedicalCertificate();
        $result = $MC-> viewIndvMC($medicalcertificateID);
        return $result;
    }
}
?>