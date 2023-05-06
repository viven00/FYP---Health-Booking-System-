<?php

class Appointment
{
    private $appointmentID;
    private $patientID;
    private $appointmentDate;
    private $appointmentTime;
    private $doctor;
    private $medicalField;
    private $fee;
    private $status;

    private $startdate;
    private $enddate;
    private $issuedate;
    private $medicalleavetype;
    private $breakdays;


    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }

    function ptGetCurrAppt($medicalField, $doctor, $appointmentDate,$status)
    {
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM appointment WHERE status = '$status' AND appointment.patientID='$userID' and appointmentDate >= CURRENT_DATE() ";
 
        if ($medicalField != null) {
            $sql .= "AND medicalField = '$medicalField' ";
        }
        if ($doctor != null) {
            $sql .= "AND doctor LIKE '%$doctor%' ";
        }
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }
        $sql .= "order by appointmentDate";
        $result = @$this->conn->query($sql);
        
        return $result;
    }

    function ptGetPastAppt($medicalField, $doctor, $appointmentDate,$status)
    {
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM appointment WHERE ((appointmentDate < CURRENT_DATE() AND appointment.patientID='$userID') or (appointment.patientID='$userID' and status = '$status')) ";

        if ($medicalField != null) {
            $sql .= "AND medicalField like '%$medicalField%' ";
        }
        if ($doctor != null) {
            $sql .= "AND doctor LIKE '%$doctor%' ";
        }
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }
        $sql .= "order by appointmentDate";
        $result = @$this->conn->query($sql);
        
        return $result;
    }

    function viewAppt($medicalField, $doctor, $appointmentDate,$status)
    {
        $sql = "SELECT * FROM appointment WHERE status = '$status' and appointmentDate > NOW()";

        if ($medicalField != null) {
            $sql .= "AND medicalField like '%$medicalField%' ";
        }
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }
        if ($doctor != null) {
            $sql .= "AND doctor LIKE '%$doctor%' ";
        }
        $sql .= "order by appointmentDate";
        $result = @$this->conn->query($sql);
        
        return $result;
    }

    public function getIndivAppt($appointmentID) 
    {
        $sql = "SELECT * FROM appointment  WHERE appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);
        return $result;
    }
    
    public function bookAppt($appointmentID,$patientID, $status)
    {

        $sql = "UPDATE appointment SET patientID = '$patientID' , status = '$status' 
        where appointmentID = '$appointmentID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function getIndivCurrAppt($appointmentID) 
    {
        $sql = "SELECT * FROM appointment WHERE appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function deleteAppt($appointmentID,$patientID, $status)
    {

        $sql = "UPDATE appointment SET patientID = '$patientID' , status = '$status' 
        where appointmentID = '$appointmentID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function cfmBookAppt($appointmentID,$patientID, $status)
    {

        $sql = "UPDATE appointment SET patientID = '$patientID' , status = '$status' 
        where appointmentID = '$appointmentID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function updateAppt($appointmentID,$patientID, $status)
    {
        $sql = "UPDATE appointment SET patientID = '$patientID' , status = '$status' 
        where appointmentID = '$appointmentID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $updateAppt = TRUE;
        }
        else {
            return $updateAppt = FALSE;
        }
    }
    

    
    function DrGetCurrAppt($appointmentDate,$status)
    {
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM appointment join user on appointment.patientID = user.userID WHERE status = '$status' AND appointment.userID='$userID' AND appointment.appointmentDate >= CURRENT_DATE()  ";
 
        
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }
        
        $sql .= "order by appointmentDate";
        $result = @$this->conn->query($sql);
        
        return $result;
    }

    
    function NurseGetCurrAppt($medicalField, $doctor, $appointmentDate,$status)
    {
        $sql = "SELECT * FROM appointment join user on appointment.patientID = user.userID WHERE status = '$status'";
 
        if ($medicalField != null) {
            $sql .= "AND medicalField = '$medicalField' ";
        }
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }
        if ($doctor != null) {
            $sql .= "AND doctor like '%$doctor%' ";
        }
        $sql .= "order by appointmentDate";
        $result = @$this->conn->query($sql);
        
        return $result;
    }

    function AdminGetCurrAppt($medicalField, $doctor, $appointmentDate,$status)
    {
        $sql = "SELECT * FROM appointment join user on appointment.patientID = user.userID WHERE status = '$status'";
 
        if ($medicalField != null) {
            $sql .= "AND medicalField = '$medicalField' ";
        }
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }
        if ($doctor != null) {
            $sql .= "AND doctor like '%$doctor%' ";
        }
        $sql .= "order by appointmentDate";
        $result = @$this->conn->query($sql);
        
        return $result;
    }

    function SearchReAppt($medicalField, $doctor, $appointmentDate,$status)
    {
        $sql = "SELECT * FROM appointment WHERE status = '$status' AND appointment.appointmentDate > CURRENT_DATE() ";
 
        if ($medicalField != null) {
            $sql .= "AND medicalField = '$medicalField' ";
        }
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }
        if ($doctor != null) {
            $sql .= "AND doctor like '%$doctor%' ";
        }
        $sql .= "order by appointmentDate";
        $result = @$this->conn->query($sql);
        
        return $result;
    }


    function UpdateFee($fee, $appointmentID)
    {
        $sql = "UPDATE appointment SET fee = '$fee' WHERE appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    function UpdateCertificate($startdate, $enddate, $issuedate, $appointmentID, $medicalleavetype, $breakdays)
    {
        $sql = "UPDATE medicalcertificates SET startdate = '$startdate', enddate='$enddate', issuedate='$issuedate',breakdays='$breakdays', medicalleavetype='$medicalleavetype' WHERE appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

      public function DrUpdateFee($appointmentID, $fee) {
        $sql = "UPDATE appointment SET fee = '$fee' WHERE appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation2 = TRUE;
        }
        else {
            return $validation2 = FALSE;
        }
    }

    public function completeAppt($appointmentID,$status)
    {
        $sql = "UPDATE appointment SET  status = '$status' 
        where appointmentID = '$appointmentID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }
    
    public function DrGetIndivCurrAppt($appointmentID) 
    {
        $sql = "SELECT * FROM appointment join user on appointment.patientID = user.userID WHERE appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getApptID($scheduleID, $selectedTS)
    {
        $sql = "SELECT appointmentID FROM appointment WHERE doctor_schedule_id = '$scheduleID' AND appointmentTime = '$selectedTS'";
        $result = @$this->conn->query($sql);
        return $result;

    }

    
}
