<?php
include_once("User.php"); // include user entity to call function
include_once("UserProfile.php");
class LoginController
{
    function validateLogin($username, $password)
    {
        $user = new User();
        $validation = $user->getUserAccount($username, $password);

        if ($validation == true) 
        {
            
            $profileID = $user->getUserProfile($username);
            $userProfile = new UserProfile;
            $userID = $user->getUserID($username);
            $profileName = $userProfile->getProfileName($profileID);
            $userName = $user->getUserName($username);
            //set session
            $_SESSION['userID'] = $userID;
            $_SESSION['userProfile'] = $profileName;
            $_SESSION['name'] = $userName;
            $_SESSION['state'] = $profileID;

            if ($profileName == 'Patient') 
            {
                    header("location:PatientIndex.php?content=Home");
            } 
            else if ($profileName == 'Doctor') 
            {
                header("location:DoctorIndex.php?content=Home");
            }
            else if ($profileName == 'Nurse')
            {
                header("location:NurseIndex.php?content=Home");
            }

            else if ($profileName == 'Administrator')
            {
                header("location:AdminIndex.php?content=Home");
            }

            else
            {
                header("Location: index.php");
            }
           
        } 
        else 
        {
            return failure_alert("The username/password is incorrect.");
        }
    }

}
