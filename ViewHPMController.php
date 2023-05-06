<?php
include_once("HPM.php"); 

class ViewHPMController
{
    public function getHpm()
    {
		$hpm = new HPM();
		$result = $hpm->getHpm();
        return $result;
    }
}
?>