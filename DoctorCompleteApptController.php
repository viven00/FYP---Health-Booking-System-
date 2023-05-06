<?php
include_once("Appointment.php");// include user entity to call function

class DoctorCompleteApptController
{

    function completeAppt($appointmentID)
    {
        $currAppt = new appointment();

        $validation = $currAppt -> completeAppt($appointmentID,'expired');

        if($validation == true )
        {
            return success_alert("The appointment has been completed!");
        } 
        else 
        {
            return failure_alert("The appointment has not completed.");
        }
        

    }

    public function DrGetIndivCurrAppt($appointmentID)
    {
		$currAppt = new appointment();
		$result = $currAppt->DrGetIndivCurrAppt($appointmentID);
        return $result;
    }

}
?>



