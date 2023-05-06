<?php
include_once("Referral.php");

class ViewIndvReferralController
{
    function ViewIndvReferral($referralID)
    {
        $referral = new Referral();
        $result = $referral->ViewIndvReferral($referralID);
        return $result;
    }
}
?>