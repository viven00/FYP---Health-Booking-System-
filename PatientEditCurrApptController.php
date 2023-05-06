<?php
include_once("Appointment.php");// include user entity to call function

class PatientEditCurrApptController
{

    function SearchReAppt($medicalField, $doctor,$appointmentDate )
    {
        $currAppt = new appointment();
        $result = $currAppt-> SearchReAppt($medicalField, $doctor, $appointmentDate,'upcoming');
        return $result;
    }


    public function getIndivCurrAppt($appointmentID)
    {
		$currAppt = new appointment();
		$result = $currAppt->getIndivCurrAppt($appointmentID);
        return $result;
    }
}
?>
