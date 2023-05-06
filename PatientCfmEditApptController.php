<?php
include_once("Appointment.php");

class PatientCfmEditApptController
{
    function cfmBookAppt($appointmentID, $pastAppointmentID)
    {
        $Appt = new appointment();

        $updateAppt = $Appt -> updateAppt($pastAppointmentID,' ',"upcoming");

        if($updateAppt == true )
        {
            $validation = $Appt->cfmBookAppt($appointmentID,$_SESSION['userID'],"booked");
            if ($validation == true) 
            {
                return success_alert("Thank You. Your appointment has been updated!");
            } 
            else 
            {
                return failure_alert("Sorry, your appointment has not changed.");
            }
        }
        else
        {
            return failure_alert("Your appointment has been changed. Please book another appointment.");
        }
    }





}
