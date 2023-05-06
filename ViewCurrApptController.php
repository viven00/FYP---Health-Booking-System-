<?php
include_once("Appointment.php");// include user entity to call function

class ViewCurrApptController
{
    
    function ptGetCurrAppt($medicalField, $doctor, $appointmentDate )
    {
        $currAppt = new appointment();
        $result = $currAppt-> ptGetCurrAppt($medicalField, $doctor, $appointmentDate,'booked');
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


