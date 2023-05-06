<?php
include_once("Schedule.php"); 

class ViewScheduleController
{
    public function DoctorSearchSchedule($dSDate) {
        $schedule = new Schedule();
        $result = $schedule->DoctorSearchSchedule($dSDate);
        return $result;
    }

    public function AdminSearchSchedule($dName) {
        $schedule = new Schedule();
        $result = $schedule->AdminSearchSchedule($dName);
        return $result;
    }

    public function getIndivSchedule() {
        $schedule = new Schedule();
        $result = $schedule->getIndivSchedule();
        return $result;
    } 

    public function getParticularSchedule($scheduleID) {
        $schedule = new Schedule();
        $result = $schedule->getParticularSchedule($scheduleID);
        return $result;
    }
    public function getDoctors(){
        $schedule = new Schedule();
        $result = $schedule->getDoctors();
        return $result;
    }
    
}
?>