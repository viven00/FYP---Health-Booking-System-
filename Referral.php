<?php

class Referral 
{
    private $appointmentID;
    private $doctorID;
    private $referDate;
    private $patientName;
    private $patientIC;
    private $referredField;
    private $reason;
    
    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }

    public function ViewPatientReferral($appointmentDate)
    {
        $userID = $_GET['userID'];

        $sql = "SELECT * FROM referral join appointment 
        on appointment.appointmentID = referral.appointmentID 
        join user on user.userID = appointment.patientID
        WHERE user.userID = '$userID'";
 
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }

        $result = @$this->conn->query($sql);
        
        return $result;
    }

    public function ViewIndvReferral($referralID)
    {
        $sql = "select * from referral 
        join appointment on referral.appointmentID = appointment.appointmentID
        join user on user.userID = appointment.patientID  
        where referralID = $referralID";
        $result = @$this->conn->query($sql);

        return $result;
    }

    public function CreateReferral($referDate, $appointmentID, $doctorID, $patientName, $patientIC, $referredField, $reason)
    {
        $sql = "INSERT INTO referral(referDate, appointmentID, doctorID, patientName, patientIC, referredField, reason) 
        VALUES('$referDate', '$appointmentID','$doctorID','$patientName','$patientIC','$referredField','$reason')";
        $qRes = @$this->conn->query($sql);

        if ($qRes === TRUE) {
            return $validation = true;
        } else {
            return $validation = false;
        }   
    }

    public function UpdateReferral($referralID, $referredField, $reason)
    {
        $sql = "UPDATE referral SET ";

        if (!empty($referredField)) {
            $sql .= "referredField = '$referredField',";
        }

        if (!empty($reason)) {
            $sql .= "reason = '$reason',";
        }

        // Take away the comma at the back of string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE referralID = '$referralID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function getAppointment()
    {
        $appointmentID = $_GET['appointmentID'];
        $sql = "select * from appointment 
        join user on appointment.patientID = user.userID 
        where appointment.appointmentID = $appointmentID";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getMedicalFields()
    {
        $sql = "SELECT * FROM medicalfield";

        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $mfArr[] = $row;
        }

        return $mfArr;
    }
}
?>