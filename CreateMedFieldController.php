<?php
include_once("medicalField.php"); // include user entity to call function
class CreateMedFieldController
{
    function addMedicalField($medicalField)
    {
        $MF = new medicalField();
        $checkMedicalField = $MF->checkDuplicateMedicalField($medicalField);

        if ($checkMedicalField == true) 
        {
            $validation = $MF->addMedicalField($medicalField);
            if ($validation == true) 
            {
                return success_alert("New medical field has been successfully added!");
            } 
            else 
            {
                return failure_alert("Unable to add medical field.");
            }
        }
        else
        {
            return failure_alert("This medical field already exists. Please create another medical field.");
        }
    }

    public function getMedicalField()
    {
		$MF = new medicalField();
		$result = $MF->getMedicalField();
        return $result;
    }

    public function getIndivMF($medicalFieldID)
    {
		$MF = new medicalField();
		$result = $MF->getIndivmf($medicalFieldID);
        return $result;
    }
	
    public function getAllMedicalField()
    {
		$MF = new medicalField();
		$result = $MF->getAllMedField();
        return $result;
    }
}
