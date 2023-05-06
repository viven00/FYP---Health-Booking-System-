<?php
include_once("HPM.php"); 

class CreateHPMController
{
    function CreateHPM($HPMdescriptions) {
        $hpm = new HPM();
        $validation = $hpm->CreateHPM($HPMdescriptions);
        if ($validation == TRUE) {
            return success_alert("Health Promotion Message successfully published!");
        }
        else {
            return failure_alert("Unable to publish Health Promotion Message.");
        }
    }

    function UpdateHPM($HPMdescriptions) {
        $hpm = new HPM();
        $validation = $hpm->UpdateHPM($HPMdescriptions);
        if ($validation == TRUE) {
            return success_alert("Health Promotion Message successfully published!");
        }
        else {
            return failure_alert("Unable to publish Health Promotion Message.");
        }
    }

    public function getHpm()
    {
		$hpm = new HPM();
		$result = $hpm->getHpm();
        return $result;
    }
}
?>