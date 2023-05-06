<?php
include_once("MedicalCertificate.php");// include user entity to call function

class ViewPastMCController
{
    public function getIndivMC($appointmentID)
    {
		$MC = new medicalCertificate();
		$result = $MC->getIndivMC($appointmentID);
        return $result;
    }
}

?>

