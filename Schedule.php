<?php
include_once("Timeslots.php");

class Schedule
{
    private $dID;
    private $dSDate;
    private $dSDay;
    private $dSStartTime;
    private $dSEndTime;
    private $avgConsultingTime;
    
    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }
    
	public function CreateDoctorSchedule($dID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime){
        $sql = "INSERT INTO doctor_schedule(userID, doctor_schedule_date, doctor_schedule_day, doctor_schedule_start_time, doctor_schedule_end_time, average_consulting_time)
        VALUES ('$dID', '$dSDate', '$dSDay', '$dSStartTime', '$dSEndTime', '$avgConsultingTime')";
        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function UpdateDoctorSchedule($dscheduleID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime){
        $sql = "UPDATE doctor_schedule SET ";

        if (!empty($dSDate)) {
            $sql .= "doctor_schedule_date = '$dSDate',";
        }
        if (!empty($dSDay)) {
            $sql .= "doctor_schedule_day = '$dSDay',";
        }

        if (!empty($dSStartTime)) {
            $sql .= "doctor_schedule_start_time = '$dSStartTime',";
        }

        if (!empty($dSEndTime)) {
            $sql .= "doctor_schedule_end_time = '$dSEndTime',";
        }

        if (!empty($avgConsultingTime)) {
            $sql .= "average_consulting_time = '$avgConsultingTime',";
        }

        // Take away the comma at the back of string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE doctor_schedule_id = '$dscheduleID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function getDoctors(){
        $sql = "SELECT * FROM doctor";

        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $doctArr[] = $row;
        }

        return $doctArr;
    }

    public function getAllSchedule() {
        $sql = "SELECT * FROM doctor_schedule ORDER BY doctor_schedule_date";

        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $scheduleArr[] = $row;
        }

        return $scheduleArr;
    } 

    public function getIndivSchedule() {
        $uid = $_SESSION['userID'];
        $sql = "SELECT * FROM doctor_schedule WHERE userID ='$uid'";
        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $scheduleArr[] = $row;
        }

        return $scheduleArr;
    } 

    public function getParticularSchedule($scheduleID) {
        $sql = "SELECT * FROM doctor_schedule WHERE doctor_schedule_id = '$scheduleID'";
        $result = @$this->conn->query($sql);
        return $result;
    } 

    public function DoctorSearchSchedule($dSDate) {
        $uid = $_SESSION['userID'];
        $sql = "SELECT * FROM doctor_schedule WHERE userID ='$uid' AND DATE(doctor_schedule_date) >= CURRENT_DATE()";

        if ($dSDate != null) {
            $sql .= " AND doctor_schedule_date LIKE '%$dSDate%' ";
        }

        $sql .= "ORDER BY doctor_schedule_date";

        $result = @$this->conn->query($sql);
        return $result;
    }

    public function AdminSearchSchedule($dName) {
        $sql = "SELECT * FROM doctor_schedule AS ds INNER JOIN doctor AS d ON ds.userID = d.userID WHERE name IS NOT NULL
            AND DATE(doctor_schedule_date) >= CURRENT_DATE()";

        if ($dName != null) {
            $sql .= " AND name LIKE '%$dName%' ";
        }

        $sql .= "ORDER BY doctor_schedule_date";

        $result = @$this->conn->query($sql);
        return $result;
    }

    public function deleteSchedule($scheduleID) {
        $sql = "DELETE FROM doctor_schedule WHERE doctor_schedule_id = '$scheduleID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function CreateAppointmentSlot($aDate, $uid, $scheduleID){
        $scheduleID = $_POST['scheduleID'];
        //$uid = $_SESSION['userID'];
        $doctInfo = @$this->conn->query("SELECT * FROM doctor WHERE userID ='$uid'");

        while ($row = $doctInfo->fetch_assoc()) {
            $doctInfoArr[] = $row;
            $doctname = $row['name'];
            $medicalField = $row['field'];
        }

        @$this->conn->query("UPDATE doctor_schedule SET doctor_schedule_status='Activated' WHERE doctor_schedule_id ='$scheduleID'");

        $t = new Timeslots();
        $timeslotArray = array();
        $timeslotArray = $t->getTimeslot($scheduleID);
        $appointmentSlot = array();

        for ($i = 1; $i< count($timeslotArray)+1; $i++) {
            $appointmentSlot[$i] = $timeslotArray[$i]['slotStartTime']. '-' . $timeslotArray[$i]['slotEndTime'];
        }
    
        for ($i = 1; $i< count($appointmentSlot)+1; $i++) {
            $appointmentTime =  $appointmentSlot[$i];
            $patientID =  0;
            $status = "upcoming";

            $sql = "INSERT INTO appointment(patientID, appointmentDate, appointmentTime, medicalField, doctor, fee, status, userID, doctor_schedule_id) 
            VALUES ('$patientID','$aDate','$appointmentTime','$medicalField','$doctname', '-','$status','$uid','$scheduleID')";
            $result = @$this->conn->query($sql);   
        }

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function CreateIndivTS($aDate, $appointmentTime, $uid, $scheduleID){
        $patientID =  0;
        $status = "upcoming";
        $uid = $_SESSION['userID'];
        $doctInfo = @$this->conn->query("SELECT * FROM doctor WHERE userID ='$uid'");

        while ($row = $doctInfo->fetch_assoc()) {
            $doctInfoArr[] = $row;
            $doctname = $row['name'];
            $medicalField = $row['field'];
        }

        $sql = "INSERT INTO appointment(patientID, appointmentDate, appointmentTime, medicalField, doctor, fee, status, userID, doctor_schedule_id) 
        VALUES ('$patientID','$aDate','$appointmentTime','$medicalField','$doctname', '-','$status','$uid','$scheduleID')";
        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function checkDuplicate($appointmentTime, $scheduleID)
    {
        $sql = "SELECT * FROM appointment WHERE appointmentTime='$appointmentTime' AND doctor_schedule_id='$scheduleID'";
        $qRes = @$this->conn->query($sql);
        if (mysqli_num_rows($qRes) == 0) {
            return $checkTime = true;
        } else {
            return $checkTime = false;
        }
    }

    public function getDrID($scheduleID)
    {
        $sql = "SELECT userID FROM doctor_schedule WHERE doctor_schedule_id='$scheduleID'";
        $result = @$this->conn->query($sql);
        return $result;
    }
}
?>