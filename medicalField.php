<?php

class MedicalField
{
    private $medicalFieldID;
    private $medicalField;
    private $conn = NULL;
    
    function __construct()
    {
        include("config.php");
        $this->conn = $conn;
    }

    public function addMedicalField($medicalField)
    {
        $sql = "INSERT INTO medicalfield (medicalField) VALUES ('$medicalField')" ; 
        "ALTER TABLE medicalField AUTO_INCREMENT = 1;";
       
        $queryResult = @$this->conn->query($sql);
        if ($queryResult === TRUE)
        {
            return $validation = true;
        } 
        else
        {
            return $validation = false;
        }
    }

    public function checkDuplicateMedicalField($medicalField)
    {
        $sql = "SELECT * FROM medicalfield WHERE medicalField='$medicalField'";
        $qRes = @$this->conn->query($sql);
        if (mysqli_num_rows($qRes) == 0) 
        {
            return $checkMedicalField = true;
        } 
        else 
        {
            return $checkMedicalField= false;
        }
    }

    public function getMedicalField() 
    {
       
        $sql = "SELECT * FROM medicalfield ORDER BY medicalFieldID";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function deleteMF($medicalFieldID) {
        $sql = "DELETE FROM medicalfield WHERE medicalFieldID = '$medicalFieldID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getIndivMF($medicalFieldID) 
    {
        $sql = "SELECT * FROM medicalfield WHERE medicalFieldID = '$medicalFieldID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getMedField($medicalFieldID)
    {
        $sql = "SELECT medicalField FROM medicalField WHERE medicalFieldID = $medicalFieldID";
        $qRes = @$this->conn->query($sql);

        if ($qRes == TRUE) 
        {
            $row = $qRes -> fetch_assoc();
            return $row ['medicalField'];
        } 
        else 
        {
            return failure_alert("user profile does not exist");
        }
    }

    public function getAllMedField()
    {
        $sql = "SELECT * FROM medicalfield order by medicalfield";
        $result = @$this->conn->query($sql);
        return $result;
    }

}
