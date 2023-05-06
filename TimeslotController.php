<?php
include_once("Timeslots.php"); 

class TimeslotController
{
    function getTimeslot($scheduleID) 
    {
        $t = new Timeslots();
        $result = $t->getTimeslot($scheduleID);
        return $result;
    }
}
?>