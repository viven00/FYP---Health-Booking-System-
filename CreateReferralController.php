<?php
include_once("Referral.php");

class CreateReferralController
{
    function CreateReferral($referDate, $appointmentID, $doctorID, $patientName, $patientIC, $referredField, $reason)
    {
        $referral = new Referral();
        $validation = $referral->CreateReferral($referDate, $appointmentID, $doctorID, $patientName, $patientIC, $referredField, $reason);

        if ($validation == TRUE) {
            return success_alert("Referral letter created successfully!");
        }
        else {
            return failure_alert("Unable to add referral letter.");
        }
    }

    function getAppointment($appointmentID)
    {
        $appointment = new Referral();
        $result = $appointment->getAppointment($appointmentID);
        return $result;
    }

    function getMedicalFields()
    {
        $medicalFields = new Referral();
        $result = $medicalFields->getMedicalFields();
        return $result;
    }
}
?>