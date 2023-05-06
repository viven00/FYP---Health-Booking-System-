<?php
include_once("Referral.php");

class DoctorViewReferralController
{
    function ViewPatientReferral($appointmentDate)
    {
        $ptReferral = new Referral();
        $result = $ptReferral->ViewPatientReferral($appointmentDate);
        return $result;
    }
}
?>