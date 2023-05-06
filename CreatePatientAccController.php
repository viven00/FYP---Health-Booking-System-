<?php
include_once("User.php");// include user entity to call function
include_once("UserProfile.php");
class AddUserController
{

    function addAccount($username,$password,$name,$ic,$gender,$dob,$email,$phoneNumber,$userProfile)
    {
        $user = new User();
        $checkUsername = $user->checkDuplicateUsername($username);
        
        if ($checkUsername == true)
        {
            $validation = $user->addUserAccount($username,$password,$name,$ic,$gender,$dob,$email,$phoneNumber,$userProfile);
            if ($validation == true)
            {
                return success_alert("User account is successfully created!");
            }
            else
            {
                return failure_alert("Unable to create user account.");
            }
        }
        else
        {
            return failure_alert("This username is not available. Please use another username.");
        }
    }
}