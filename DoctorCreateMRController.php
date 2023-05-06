<?php
include_once("MedicalRecord.php"); // include user entity to call function
include_once("Appointment.php");
class DoctorCreateMRController
{
    function createMedicalRecord($appointmentID, $patientName, $patientIC, $weight, $height, $diagnosis, $prescription, $doctorID, $fee, $img)
    {
            $medicalRecords = new MedicalRecords();
            $validation = $medicalRecords -> createMedicalRecord($appointmentID, $patientName,$patientIC, $weight, $height, $diagnosis, $prescription, $doctorID, $img);

            if ($validation == true) 
            {
                $appt = new Appointment();
                $appt -> UpdateFee($fee, $appointmentID);
                return success_alert("Medical record created successfully!");
            } 
            else 
            {
                return failure_alert("Unable to generate medical record.");
            }
    }


    function createMedicalRecord2($appointmentID, $patientName, $patientIC, $weight, $height, $diagnosis, $prescription, $doctorID, $fee)
    {
        $medicalRecords = new MedicalRecords();
        $validation = $medicalRecords -> createMedicalRecord2($appointmentID, $patientName,$patientIC, $weight, $height, $diagnosis, $prescription, $doctorID);

        if ($validation == true) 
        {
            $appt = new Appointment();
            $appt -> UpdateFee($fee, $appointmentID);
            return success_alert("Medical record created successfully!");
        } 
        else 
        {
            return failure_alert("Unable to generate medical record.");
            }
    }
}