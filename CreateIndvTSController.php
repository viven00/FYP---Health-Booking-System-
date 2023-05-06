<?php
include_once("Schedule.php");  

class CreateIndvTSController
{
    function CreateIndivTS($aDate, $appointmentTime, $uid, $scheduleID){
        $schedule = new Schedule();
        $check = $schedule->checkDuplicate($appointmentTime, $scheduleID);

        if ($check == TRUE)
        {
            $validation = $schedule->CreateIndivTS($aDate, $appointmentTime, $uid, $scheduleID);

            if ($validation == TRUE) {
                return success_alert("Timeslot added successfully!");
            }
            else {
                return failure_alert("Unable to add the timeslot");
            }
        }
        else
        {
            return failure_alert("Timeslot already exists!");
        }
    }
}
?>