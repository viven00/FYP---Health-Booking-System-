<?php
include_once("User.php");
include_once("HPM.php");

class SendHPMController
{
    public function getName($userID)
    {   
        $user = new user();
        $result = $user->getName($userID);
        return $result;

    }

    public function getEmails() 
    {
        $user = new user();
        $result = $user->getEmails();
        return $result;
    }

    public function getHPM()
    {
        $hpm = new HPM();
        $result = $hpm->getHpm();
        return $result;
    }
}
?>