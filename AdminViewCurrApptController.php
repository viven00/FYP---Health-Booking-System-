<?php
include_once("Appointment.php");// include user entity to call function

class AdminViewCurrApptController
{
    
    function AdminGetCurrAppt($medicalField, $doctor, $appointmentDate )
    {
        $currAppt = new appointment();
        $result = $currAppt-> AdminGetCurrAppt($medicalField, $doctor, $appointmentDate,'booked');
        return $result;
    }

}
?>


