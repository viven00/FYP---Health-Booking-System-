<?php

class Timeslots 
{
    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }
    
    public function getTimeslot($scheduleID){

        $sql = "SELECT * FROM doctor_schedule WHERE doctor_schedule_id = '$scheduleID'";
        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $start = new DateTime($row["doctor_schedule_start_time"]);
            $end = new DateTime($row["doctor_schedule_end_time"]); 
            $interval = $row["average_consulting_time"];
            $startTime = $start->format('H:i');
            $endTime = $end->format('H:i');
            $i = 0;
            $time = [];

            while(strtotime($startTime)<=strtotime($endTime))
            {
                $start = $startTime;
                $end = date('H:i', strtotime('+'.$interval.'minutes',strtotime($startTime)));
                $startTime = date('H:i', strtotime('+'.$interval.'minutes',strtotime($startTime)));
                $i++;
                if(strtotime($startTime)<=strtotime($endTime)){
                    $time[$i]['slotStartTime'] = $start;
                    $time[$i]['slotEndTime'] = $end;
                }
            } 

            return $time;;
        }
    }

    public function getIndivApptTS($scheduleID) {
        $sql = "SELECT * FROM appointment WHERE doctor_schedule_id = '$scheduleID' AND patientID='0'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getAllTS()
    {
        $sql = "SELECT * FROM appointment";
        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $TSArr[] = $row;
        }

        return $TSArr;
    }

    public function deleteTS($scheduleID, $timeslot) {
        $sql = "DELETE FROM appointment WHERE doctor_schedule_id = '$scheduleID' AND appointmentTime = '$timeslot'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function checkTS($scheduleID, $timeslot) {
        $sql = "SELECT * FROM appointment WHERE doctor_schedule_id = '$scheduleID' AND appointmentTime = '$timeslot'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    
}
?>