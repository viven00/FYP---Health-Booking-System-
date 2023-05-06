<?php 
include_once("MedicalCertificate.php");

class DoctorCreateMCController
{
    function createMedicalCertificate($appointmentID, $doctorID, $patientName, $patientIC, $noOfDays, $issueDate, $startDate, $endDate)
    {
        $medicalcert = new MedicalCertificate();
        $validation = $medicalcert->createMedicalCertificate($appointmentID, $doctorID, $patientName, $patientIC, $noOfDays, $issueDate, $startDate, $endDate);

        if ($validation == TRUE) {
            return success_alert("Medical certificate added successfully!");
        }
        else {
            return failure_alert("Unable to add medical certificate");
        }
    }

    function getAppointment($appointmentID)
    {
        $appointment = new MedicalCertificate();
        $result = $appointment->getAppointment($appointmentID);
        return $result;
    }
}

?>