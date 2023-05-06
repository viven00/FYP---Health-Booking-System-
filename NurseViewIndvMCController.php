<?php
include_once("MedicalCertificate.php");// include user entity to call function

class NurseViewIndvMCController
{
    
    function viewIndvMC($medicalcertificateID)
    {
        $MC= new medicalcertificate();
        $result = $MC-> viewIndvMC($medicalcertificateID);
        return $result;
    }

}
?>


