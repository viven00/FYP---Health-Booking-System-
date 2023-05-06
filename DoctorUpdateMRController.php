<?php
include_once("MedicalRecord.php");
include_once("Appointment.php");

class DoctorUpdateMRController
{
    function DrUpdateMR($appointmentID,$weight, $height, $diagnosis, $prescription, $fee, $img)
    {
            $medicalRecords = new MedicalRecords();
            $validation = $medicalRecords -> UpdateMR($appointmentID,$weight, $height, $diagnosis,$prescription ,$img);

            $appt = new Appointment();
            $validation2 = $appt -> DrUpdateFee($appointmentID, $fee);
            if ($validation == true ) 
            { 
                return success_alert("Medical Record Updated");
            }
             elseif($validation2 == true)    
            {
                return success_alert("Medical Record Updated");
            } 
            else 
            {
                return failure_alert("Unable to update Medical Record.");
            }         
    }

    function DrUpdateMR2($appointmentID,$weight, $height, $diagnosis, $prescription, $fee)
    {
        $medicalRecords = new MedicalRecords();
        $validation = $medicalRecords -> UpdateMR2($appointmentID,$weight, $height, $diagnosis,$prescription);

        $appt = new Appointment();
        $validation2 = $appt -> DrUpdateFee($appointmentID, $fee);
        if ($validation == true ) 
        { 
            return success_alert("Medical Record Updated");
        }
         elseif($validation2 == true)    
        {
            return success_alert("Medical Record Updated");
        } 
        else 
        {
            return failure_alert("Unable to update Medical Record.");
        }      
            
    }

}