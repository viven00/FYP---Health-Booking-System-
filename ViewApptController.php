<?php
include_once("Appointment.php");// include user entity to call function

class ViewApptController
{
    
    function viewAppt($medicalField, $doctor, $appointmentDate )
    {
        $Appt = new appointment();
        $result = $Appt-> viewAppt($medicalField, $doctor, $appointmentDate,'upcoming');
        return $result;
    }

    public function getIndivAppt($appointmentID)
    {
		$Appt = new appointment();
		$result = $Appt->getIndivAppt($appointmentID);
        return $result;
    }


}
?>


