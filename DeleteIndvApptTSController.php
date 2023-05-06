<?php
include_once("Timeslots.php");

class DeleteIndvApptTSController
{
    function deleteTS($scheduleID, $timeslot)
    {
        $ts = new Timeslots();
        $validation = $ts->deleteTS($scheduleID, $timeslot);

        if ($validation == TRUE) {
            return success_alert("Timeslot deleted successfully!");
        }
        else {
            return failure_alert("Unable to delete the timeslot");
        }
    }

    function checkTS($scheduleID, $timeslot)
    {
        $ts = new Timeslots();
        $result = $ts->checkTS($scheduleID, $timeslot);
        return $result;
       
    }
}
?>