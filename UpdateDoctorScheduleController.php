<?php
include_once("Schedule.php");
class UpdateDoctorScheduleController
{
    function UpdateDoctorSchedule($dscheduleID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime)
    {
        $schedule = new Schedule();
        $validation = $schedule->UpdateDoctorSchedule($dscheduleID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime);
        if ($validation == true) 
        {
            return success_alert("Doctor schedule successfully updated!");
        } 
        else 
        {
            return failure_alert("Unable to update the Doctor schedule.");
        }
    }
}
?>