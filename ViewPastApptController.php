<?php
include_once("Appointment.php");// include user entity to call function

class ViewPastApptController
{
    
    function ptGetPastAppt($medicalField, $doctor, $appointmentDate )
    {
        $pastAppt = new appointment();
        $result = $pastAppt-> ptGetPastAppt($medicalField, $doctor, $appointmentDate,'expired');
        return $result;
    }

}
?>


