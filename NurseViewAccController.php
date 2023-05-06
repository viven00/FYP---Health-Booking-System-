<?php
include_once("User.php");// include user entity to call function
include_once("UserProfile.php");
class NurseViewAccController
{
    function userViewAcc($userId,$userName,$fullname,$gender,$dob,$email,$phoneNumber)
    {
        $user = new User();
        $result = $user->userViewAcc($userId,$userName,$fullname,$gender,$dob,$email,$phoneNumber);
        return $result;
    }
}
?>