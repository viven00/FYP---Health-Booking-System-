<?php
include_once("Appointment.php");// include user entity to call function

class DoctorViewCurrApptController
{
    
    function DrGetCurrAppt($appointmentDate)
    {
        $currAppt = new appointment();
        $result = $currAppt-> DrGetCurrAppt($appointmentDate,'booked');
        return $result;
    }

}
?>


