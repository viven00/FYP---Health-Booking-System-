<?php

class medicalrecords
{
    private $patientID;
    private $appointmentDate;
    private $time;
    private $doctor;
    private $doctorID;
    private $medicalField;
    private $diagnosis;
    private $prescription;
    private $status;
    private $name;
    private $ic;
    private $appointmentID;
    private $dob;
    private $wieght;
    private $height;
    private $img;
    private $patientIC;


    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }

    public function getIndivMR($appointmentID) 
    {
        $sql = "SELECT * FROM medicalrecords join appointment 
        on appointment.appointmentID = medicalrecords.appointmentID 
        join user on user.userID = appointment.patientID
        WHERE medicalrecords.appointmentID = '$appointmentID'";
        $result = @$this->conn->query($sql);
        return $result;
    }
    
    public function getMR($appointmentID)
    {
        $sql = "SELECT * FROM appointment join user on appointment.patientID = user.userID where appointmentID = $appointmentID";
        $result = @$this->conn->query($sql);
        return $result;
    }
    
    function viewPatient($name)
    {
        $userID = $_SESSION['userID'];

        $sql = "SELECT * FROM medicalrecords join appointment 
        on appointment.appointmentID = medicalrecords.appointmentID 
        join user on user.userID = appointment.patientID ";

        if ($name != null) {
            $sql .= " AND name LIKE '%$name%' ";
        }
        $sql .= "group by name";


        $result = @$this->conn->query($sql);
        
        return $result;
    }

    function viewPatientMR($appointmentDate)
    {
        $userID = $_GET['userID'];
        $sql = "SELECT * FROM medicalrecords join appointment 
        on appointment.appointmentID = medicalrecords.appointmentID 
        join user on user.userID = appointment.patientID
        WHERE user.userID = '$userID'";
 
        if ($appointmentDate != null) {
            $sql .= "AND appointmentDate like '$appointmentDate' and '$appointmentDate 23:59:59' ";
        }

        $result = @$this->conn->query($sql);
        
        return $result;
    }

    function doctorGetIndivMR($medicalrecordID)
    {

        $sql = "SELECT * FROM medicalrecords join appointment 
        on appointment.appointmentID = medicalrecords.appointmentID 
        join user on user.userID = appointment.patientID
        WHERE medicalrecords.medicalrecordID = '$medicalrecordID'";

        $result = @$this->conn->query($sql);
        
        return $result;
    }

    function NurseGetIndivMR($medicalrecordID)
    {

        $sql = "SELECT * FROM medicalrecords join appointment 
        on appointment.appointmentID = medicalrecords.appointmentID 
        join user on user.userID = appointment.patientID
        WHERE medicalrecords.medicalrecordID = '$medicalrecordID'";

        $result = @$this->conn->query($sql);
        
        return $result;
    }


    function createMedicalRecord($appointmentID, $patientName, $patientIC, $weight, $height, $diagnosis, $prescription, $doctorID, $img)
    {

        // ($appointmentID, $patientName, $appointmentDate, $appointmentTime, $dob, $weight, $height, $diagnosis, $prescription, $attachment1, $attachment2);
        $sql = "INSERT INTO medicalrecords(appointmentID,name,ic,weight,height,diagnosis,prescription,doctorID,attachment1) 
        VALUES('$appointmentID','$patientName','$patientIC','$weight','$height','$diagnosis','$prescription','$doctorID','$img')";
        $qRes = @$this->conn->query($sql);

        if ($qRes === TRUE) {
            return $validation = true;
        } else {
            return $validation = false;
        }        
    }

    function createMedicalRecord2($appointmentID, $patientName, $patientIC, $weight, $height, $diagnosis, $prescription, $doctorID)
    {

        // ($patientID, $appointmentID, $patientName, $appointmentDate, $appointmentTime, $dob, $weight, $height, $diagnosis, $prescription, $attachment1, $attachment2);
        $sql = "INSERT INTO medicalrecords(appointmentID,name,ic,weight,height,diagnosis,prescription,doctorID) 
        VALUES('$appointmentID','$patientName','$patientIC','$weight','$height','$diagnosis','$prescription','$doctorID')";
        $qRes = @$this->conn->query($sql);

        if ($qRes === TRUE) {
            return $validation = true;
        } else {
            return $validation = false;
        }        
    }
    
        public function UpdateMR($appointmentID,$weight, $height, $diagnosis, $prescription, $img) {
        $sql = "UPDATE medicalrecords SET ";

        if (!empty($weight)) {
            $sql .= "weight = '$weight',";
        }
        if (!empty($height)) {
            $sql .= "height = '$height',";
        }
        if (!empty($diagnosis)) {
            $sql .= "diagnosis = '$diagnosis',";
        }
        if (!empty($prescription)) {
            $sql .= "prescription = '$prescription',";
        }
        if (!empty($img)) {
            $sql .= "attachment1 = '$img',";
        }

        // Take away the comma at the back of string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE appointmentID = '$appointmentID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function UpdateMR2($appointmentID,$weight, $height, $diagnosis, $prescription) {
        $sql = "UPDATE medicalrecords SET ";

        if (!empty($weight)) {
            $sql .= "weight = '$weight',";
        }
        if (!empty($height)) {
            $sql .= "height = '$height',";
        }
        if (!empty($diagnosis)) {
            $sql .= "diagnosis = '$diagnosis',";
        }
        if (!empty($prescription)) {
            $sql .= "prescription = '$prescription',";
        }

        // Take away the comma at the back of string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE appointmentID = '$appointmentID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function getAllPatient()
    {
        $sql = "SELECT distinct name FROM medicalrecords order by name";
        $result = @$this->conn->query($sql);
        return $result;
    }
}
