<?php
include_once("User.php"); // include user entity to call function
include_once("UserProfile.php");
class ModifyNurseAccController
{
    function getAllUserProfile()
    {
        $profileArr = array();
        $userProfile = new UserProfile();
        $profileArr = $userProfile->getAllUserProfile();
        return $profileArr;
    }

    function modifyUserAcc($userID, $username, $password, $fullname, $gender, $email, $phoneNumber)
    {
        $user = new User();
        $checkUsername = $user->checkDuplicateUsername($username);
        if ($checkUsername == true) 
        {   
            $validation = $user->modifyUserAcc($userID, $username, $password, $fullname, $gender, $email, $phoneNumber);

            if ($validation == true) 
            {
                return success_alert("User account successfully modified!");
            } 
            else 
            {
                return failure_alert("Unable to modify user account.");
            }
        } 
        else 
        {
            return failure_alert("This username is not available. Please use another username.");
        }
    }
}
