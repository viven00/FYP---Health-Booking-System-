<?php
include_once("User.php"); // include user entity to call function
include_once("UserProfile.php");
class ModifyStaffAccController
{
    function getAllUserProfile()
    {
        $profileArr = array();
        $userProfile = new UserProfile();
        $profileArr = $userProfile->getAllUserProfile();
        return $profileArr;
    }

    function modifyStaffAcc($userID, $username, $password, $fullname, $ic, $gender, $dob, $email, $phoneNumber, $userProfile)
    {
        $user = new User();
        $checkUsername = $user->checkDuplicateUsername($username);
        if ($checkUsername == true) 
        {
            $validation = $user->modifyStaffAcc($userID, $username, $password, $fullname, $ic, $gender, $dob, $email, $phoneNumber, $userProfile);

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