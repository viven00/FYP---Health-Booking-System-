<?php
include_once("Schedule.php"); 
class DeleteScheduleController
{
    function deleteSchedule($scheduleID)
    {
        $Schedule = new Schedule();

        $validation = $Schedule->deleteSchedule($scheduleID);
        if ($validation == true) 
        {
            return success_alert("Schedule successfully deleted!");
        } 
        else 
        {
            return failure_alert("Unable to delete the Schedule.");
        }
    }
}
