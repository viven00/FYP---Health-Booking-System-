<?php
include_once("DoctorDetails.php");

class ViewDoctorController
{
    
    function viewAppt($field, $name)
    {
        $DoctorDetails = new DoctorDetails();
        $result = $DoctorDetails-> viewAppt($field, $name);
        return $result;
    }

    public function getIndivAppt($userID)
    {
		$DoctorDetails = new DoctorDetails();
		$result = $DoctorDetails->getIndivAppt($userID);
        return $result;
    }

    public function getIndivDoctor($userID)
    {
		$DoctorDetails = new DoctorDetails();
		$result = $DoctorDetails->getIndivDoctor($userID);
        return $result;
    }
	
    public function getAllDoctor()
    {
		$DoctorDetails = new DoctorDetails();
		$result = $DoctorDetails->getAllDoctors();
        return $result;
    }

}
?>


