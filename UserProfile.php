<?php

class UserProfile
{
    private $profileID;
    private $profileName;
    private $status;
    private $conn = NULL;
    
    function __construct()
    {
        include("config.php");
        $this->conn = $conn;
    }

    public function getProfileName($profileID)
    {
        $sql = "SELECT * FROM userprofile WHERE profileID = $profileID";
        $qRes = @$this->conn->query($sql);
        $Row = mysqli_fetch_assoc($qRes);

        $profileName = $Row['profileName'];
        return $profileName;
    }

    public function getAllUserProfile()
    {
        $profileArr = array();  
        $sql = "SELECT * FROM userprofile";
        $qRes = @$this->conn->query($sql);

        while ($row = $qRes -> fetch_assoc())
        {
            $profileArr[$row['profileID']] = $row["profileName"];
        }

        return $profileArr;
    }

    public function getProfile($profileID)
    {
        $sql = "SELECT profileName FROM userprofile WHERE profileID = $profileID";
        $qRes = @$this->conn->query($sql);

        if ($qRes == TRUE) 
        {
            $row = $qRes -> fetch_assoc();
            return $row ['profileName'];
        } 
        else 
        {
            return failure_alert("user profile does not exist");
        }
    }

    public function searchProfile($profileID, $profileName)
    {
        $sql = "SELECT * FROM userprofile WHERE profileID IS NOT NULL ";

        if ($profileID != null)
        {
            $sql .= "AND profileID = '$profileID' ";
        }
        if ($profileName != null)
        {
            $sql .= "AND profileName LIKE '%$profileName%' ";
        }
       
        $result = @$this->conn->query($sql);
        return $result;
    }


}