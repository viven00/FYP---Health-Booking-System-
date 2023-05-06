<?php
include_once("MedicalRecord.php");

class ViewPatientProfileController
{
    function viewPatient($name)
    {
        $Patient = new medicalrecords();
        $result = $Patient-> viewPatient($name);
        return $result;
    }

    public function getAllPatient()
    {
		$patientMR = new medicalrecords();
		$result = $patientMR->getAllPatient();
        return $result;
    }
}
?>


