<?php
include_once("MedicalRecord.php");// include user entity to call function

class ViewPastMRController
{
    public function getIndivMR($appointmentID)
    {
		$pastMR = new medicalrecords();
		$result = $pastMR->getIndivMR($appointmentID);
        return $result;
    }
}

?>


