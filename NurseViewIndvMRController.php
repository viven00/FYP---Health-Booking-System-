<?php
include_once("MedicalRecord.php");// include user entity to call function

class NurseViewIndvMRController
{
    public function NurseGetIndivMR($medicalrecordID)
    {
		$indvMR = new medicalrecords();
		$result = $indvMR->NurseGetIndivMR($medicalrecordID);
        return $result;
    }
}

?>


