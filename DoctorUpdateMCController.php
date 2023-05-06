<?php
include_once("MedicalCertificate.php");

class DoctorUpdateMCController
{
    function updateMC($mcID, $noOfDays, $endDate)
    {
        $mc = new MedicalCertificate();
        $validation = $mc->updateMC($mcID, $noOfDays, $endDate);
        
        if ($validation == TRUE) {
            return success_alert("Medical certificate updated successfully!");
        }
        else {
            return failure_alert("Unable to update medical certificate.");
        }
    }
}
?>