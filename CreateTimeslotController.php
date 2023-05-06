<?php
include_once("Schedule.php"); 

class CreateTimeSlotController
{
    function CreateAppointmentSlot($aDate, $uid, $scheduleID)
    {
        $schedule = new Schedule();
        $validation = $schedule->CreateAppointmentSlot($aDate, $uid, $scheduleID);

        if ($validation == TRUE) {
            return success_alert("Appointment slots activated successfully!");
        }
        else {
            return failure_alert("Unable to activate the appointment slots");
        }
    }

    function getDrID($scheduleID)
    {
        $schedule = new Schedule();
        $result = $schedule->getDrID($scheduleID);

        return $result; 
    }
}
?>