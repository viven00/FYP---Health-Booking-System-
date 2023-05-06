<?php
include_once("Timeslots.php");

class ViewIndvApptTSController
{
    function getIndivApptTS($scheduleID)
    {
        $ts = new Timeslots();
		$result = $ts->getIndivApptTS($scheduleID);
        return $result;
    }

    function getAllTS()
    {
        $TSArr = array();
        $ts = new Timeslots();
        $TSArr = $ts->getAllTS();
        return $TSArr;
    }
}
?>