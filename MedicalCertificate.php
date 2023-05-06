<?php

class MedicalCertificate
{
    private $appointmentID;
    private $doctorID;
    private $patientName;
    private $patientIC;
    private $noOfDays;
    private $issueDate;
    private $startDate;
    private $endDate;
    private $appointmentDate;

    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }

    public function viewPatient($patientName)
    {
        $userID = $_SESSION['userID'];

        $sql = "SELECT * FROM medicalcertificates join appointment 
        on appointment.appointmentID = medicalcertificates.appointmentID 
        join user on user.userID = appointment.patientID ";

        if ($patientName != null) {
            $sql .= " AND name LIKE '%$patientName%' ";
        }
        $sql .= "group by name";

        $result = @$this->conn->query($sql);
        
        return $result;
    }

    public function viewPatientMC($appointmentDate)
    {
        $userID = $_GET['userID'];
        $sql = "SELECT * FROM medicalcertificates join appointment 
        on appointment.appointmentID = medicalcertificates.appointmentID 
        join user on user.userID = appointment.patientID
        WHERE user.userID = '$userID'";
 
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }

        $result = @$this->conn->query($sql);
        
        return $result;
    }
    
    public function createMedicalCertificate($appointmentID, $doctorID, $patientName, $patientIC, $noOfDays, $issueDate, $startDate, $endDate)
    {
        $sql = "INSERT INTO medicalcertificates(appointmentID, doctorID, patientName, patientIC, noOfDays, issueDate, startDate, endDate) 
        VALUES('$appointmentID','$doctorID','$patientName','$patientIC','$noOfDays','$issueDate','$startDate','$endDate')";
        $qRes = @$this->conn->query($sql);

        if ($qRes === TRUE) {
            return $validation = true;
        } else {
            return $validation = false;
        }        
    }

    public function getIndivMC($appointmentID) 
    {
        $sql = "SELECT * FROM medicalcertificates join appointment 
        on appointment.appointmentID = medicalcertificates.appointmentID 
        WHERE medicalcertificates.appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function viewIndvMC($medicalcertificateID)
    {
        $sql = "select * from medicalcertificates 
        join appointment on medicalcertificates.appointmentID = appointment.appointmentID
        join user on user.userID = appointment.patientID  
        where medicalcertificateID = $medicalcertificateID";
        $result = @$this->conn->query($sql);

        return $result;
    }

    public function updateMC($mcID, $noOfDays, $endDate)
    {
        $sql = "UPDATE medicalcertificates SET ";

        if (!empty($noOfDays)) {
            $sql .= "noOfDays = '$noOfDays',";
        }

        if (!empty($endDate)) {
            $sql .= "endDate = '$endDate',";
        }

        // Take away the comma at the back of string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE medicalcertificateID = '$mcID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function deleteMC($mcID)
    {
        $sql = "DELETE FROM medicalcertificates WHERE medicalcertificateID = '$mcID'";
        $result = @$this->conn->query($sql);
        return $result;
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
}