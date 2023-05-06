<?php
include_once("MedicalRecord.php");// include user entity to call function

class DoctorViewIndvMRController
{
    public function doctorGetIndivMR($medicalrecordID)
    {
		$indvMR = new medicalrecords();
		$result = $indvMR->doctorGetIndivMR($medicalrecordID);
        return $result;
    }
}

?>


