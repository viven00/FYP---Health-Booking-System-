<?php
include_once("Referral.php");

class UpdateReferralController
{
    function UpdateReferral($referralID, $referredField, $reason)
    {
        $referral = new Referral();
        $validation = $referral->UpdateReferral($referralID, $referredField, $reason);

        if ($validation == TRUE) {
            return success_alert("Referral letter updated successfully!");
        }
        else {
            return failure_alert("Unable to update referral letter");
        }
    }

    function getMedicalFields()
    {
        $medicalFields = new Referral();
        $result = $medicalFields->getMedicalFields();
        return $result;
    }
}
?>