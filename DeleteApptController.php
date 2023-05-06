<?php
include_once("Appointment.php");

class DeleteApptController
{
    function deleteAppt($appointmentID)
    {
        $currAppt = new appointment();

        $validation = $currAppt->deleteAppt($appointmentID,' ',"upcoming");
        if ($validation == true) 
        {
            return success_alert("Your appointment has been cancelled!");
        } 
        else 
        {
            return failure_alert("Sorry, your cancellation was unsuccessful.");
        }
    }


}
