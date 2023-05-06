<?php
include_once("Appointment.php");

class BookApptController
{
    function bookAppt($appointmentID)
    {
        $Appt = new appointment();

        $validation = $Appt->bookAppt($appointmentID,$_SESSION['userID'],"booked");
        if ($validation == true) 
        {
            return success_alert("Thank You. Your appointment has been booked!");
        } 
        else 
        {
            return failure_alert("Sorry, your booking was unsuccessful.");
        }
    }


}
