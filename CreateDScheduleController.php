<?php
include_once("Schedule.php"); 

class CreateDScheduleController
{
    function CreateDoctorSchedule($dID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime){
        $schedule = new Schedule();
        $validation = $schedule->CreateDoctorSchedule($dID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime);
        if ($validation == TRUE) {
            return success_alert("Schedule added successfully!");
        }
        else {
            return failure_alert("Unable add schedule");
        }
    }
}
?>