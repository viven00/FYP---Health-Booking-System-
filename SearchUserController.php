<?php
include_once("User.php");// include user entity to call function
include_once("UserProfile.php");
class SearchUserController
{
    function searchUser($userId,$userName,$fullname,$gender,$dob,$email,$phoneNumber,$userProfile)
    {
        $user = new User();
        $result = $user->searchUser($userId,$userName,$fullname,$gender,$dob,$email,$phoneNumber,$userProfile);
        return $result;
    }
    function viewProfiles()
    {
        $userProfile = new UserProfile;
        $result = $userProfile->searchProfile(null, null, null);
        return $result;
    }
    function getAllUserProfile()
    {
        $profileArr = array();
        $userProfile = new UserProfile();
        $profileArr = $userProfile->getAllUserProfile();
        return $profileArr;
    }
}
?>