<?php

class HPM
{
    private $HPMdescriptions;
    
    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }
	
	public function CreateHPM($HPMdescriptions) 
    { 
        $sql = "INSERT INTO hpm(hpmDesc)
        VALUES ('$HPMdescriptions')";
        
        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function UpdateHPM($HPMdescriptions)
    {
        $sql = "UPDATE hpm SET ";

        if (!empty($HPMdescriptions)) {
            $sql .= "hpmDesc = '$HPMdescriptions'";
        }

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function getHpm() 
    {
        $sql = "SELECT * FROM hpm ORDER BY hpmID DESC LIMIT 1";
        $result = @$this->conn->query($sql);
        return $result;
    }
}
?>