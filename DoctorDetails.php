<?php

class DoctorDetails
{
    private $userID;
    private $img;
    private $name;
    private $education;
    private $field;
    private $position;
    private $description;
    
    private $conn = NULL;

    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }
    
    public function checkDuplicateUsername($name)
    {
        $sql = "SELECT * FROM doctor WHERE name='$name'";
        $qRes = @$this->conn->query($sql);
        if (mysqli_num_rows($qRes) == 0) {
            return $checkUsername = true;
        } else {
            return $checkUsername = false;
        }
    }

    public function addDoctor($img,$userID,$name,$education,$field,$position,$description)
    {
        $un = stripslashes($name);

        $sql = "INSERT INTO doctor(img,userID,name,education,field,position,description) 
        VALUES('$img','$userID','$un','$education','$field','$position','$description')";
        $qRes = @$this->conn->query($sql);

        if ($qRes === TRUE) {
            return $validation = true;
        } else {
            return $validation = false;
        }        

    }

    function viewAppt($field, $name)
    {
        $sql = "SELECT * FROM doctor where userID is not null";

        if ($field != null) {
            $sql .= " AND field like '%$field%' ";
        }
        if ($name != null) {
            $sql .= " AND name LIKE '%$name%' ";
        }

        $result = @$this->conn->query($sql);
        
        return $result;
    }

    public function getIndivAppt($userID) 
    {
        $sql = "SELECT * FROM doctor  WHERE userID = '$userID'";
        $result = @$this->conn->query($sql);
        return $result;
    }
   
    public function getIndivDoctor($userID) 
    {
        $sql = "SELECT * FROM doctor WHERE userID = '$userID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function updateDoctor($img,$userID,$name,$education,$field,$position,$description) {
        $sql = "UPDATE doctor SET ";

        if (!empty($img)) {
            $sql .= "img = '$img',";
        }
        if (!empty($name)) {
            $sql .= "name = '$name',";
        }
        if (!empty($education)) {
            $sql .= "education = '$education',";
        }
        if (!empty($field)) {
            $sql .= "field = '$field',";
        }
        if (!empty($position)) {
            $sql .= "position = '$position',";
        }
        if (!empty($description)) {
            $sql .= "description = '$description',";
        }

        // Take away the comma at the back of string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE userID = '$userID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function deleteDoctor($userID) {
        $sql = "DELETE FROM doctor WHERE userID = '$userID'";
        $result = @$this->conn->query($sql);
        return $result;
    } 

    public function getDocID() 
    {
        $IDArr = array();  
        $sql = "select t1.userID from user t1 LEFT JOIN doctor t2 ON t2.userID = t1.userID WHERE t2.userID IS NULL AND t1.userprofile = 2";
        $qRes = @$this->conn->query($sql);

        while ($row = $qRes -> fetch_assoc())
        {
            $IDArr[$row['userID']] = $row["userID"];
        }

        return $IDArr;
    }
    
    public function getDoctor() 
    {
        $doctorArr = array();

        $sql = "SELECT * FROM doctor";
        $result = @$this->conn->query($sql);

        while($row= $result->fetch_assoc()){
            $doctorArr[]=$row;
        }
        return $result;
    }

    
    public function getAllDoctor($medicalField, $doctor ) {
        $sql = "SELECT * FROM doctor where userID is not null ";

        if ($medicalField != null) {
            $sql .= "AND field LIKE '%$medicalField%' ";
        }

        if ($doctor != null) {
            $sql .= "AND name LIKE '%$doctor%' ";
        }

        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getAllDoctors()
    {
        $sql = "SELECT name FROM doctor order by name";
        $result = @$this->conn->query($sql);
        return $result;
    }

   
}
