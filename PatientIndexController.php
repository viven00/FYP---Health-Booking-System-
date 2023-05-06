<?php
include_once("HEM.php");
include_once("HPM.php");
include_once("DoctorDetails.php");

class PatientIndexController
{
    public function getHem()
    {
		$hem = new HEM();
        $hemArr = array();
		$hemArr = $hem->getHem();
        return $hemArr;
    }

    public function getHpm()
    {
		$hpm = new HPM();
		$result = $hpm->getHpm();
        return $result;
    }

    public function getDoctor()
    {
        $doctor = new DoctorDetails();
        $doctorArr = array();
		$doctorArr = $doctor->getDoctor();
        return $doctorArr;
    }

}

?>



