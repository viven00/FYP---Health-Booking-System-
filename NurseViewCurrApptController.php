<?php
include_once("Appointment.php");// include user entity to call function

class NurseViewCurrApptController
{
    
    function NurseGetCurrAppt($medicalField, $doctor, $appointmentDate )
    {
        $currAppt = new appointment();
        $result = $currAppt-> NurseGetCurrAppt($medicalField, $doctor, $appointmentDate,'booked');
        return $result;
    }

}
?>


