<?php
include_once("Appointment.php");
include_once("User.php"); 

class ApptCancelController
{
    public function getName($userID)
    {   
        $user = new user();
        $result = $user->getName($userID);
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


