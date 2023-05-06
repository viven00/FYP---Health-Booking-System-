<?php

class User
{
    private $userID;
    private $username;
    private $password;
    private $fullname;
    private $ic;
    private $gender;
    private $dob;
    private $email;
    private $phoneNumber;
    private $status;
    private $userProfile;
    private $profileName;
    private $conn = NULL;


    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }
    

    public function getUserAccount($username, $password)
    {
        $sql = "SELECT * FROM user WHERE username ='$username' AND password ='$password'";
        $qRes = @$this->conn->query($sql);
        if (mysqli_num_rows($qRes) == 0) {
            return $validation = false;
        } else {
            return $validation = true;
        }
    }
    
    public function getUserProfileUsingID($userID)
    {
        $sql = "SELECT * FROM userprofile up INNER JOIN user u WHERE up.profileID = u.userProfile AND userID ='$userID'";
        $qRes = @$this->conn->query($sql);
        $Row = mysqli_fetch_assoc($qRes);

        $userProfile = $Row['profileName'];
        return $userProfile;
    }


    public function getUserProfile($username)
    {
        $sql = "SELECT * FROM user WHERE username ='$username'";
        $qRes = @$this->conn->query($sql);
        $Row = mysqli_fetch_assoc($qRes);

        $userProfile = $Row['userProfile'];
        return $userProfile;
        
    }

    public function getUserID($username)
    {
        $sql = "SELECT * FROM user WHERE username ='$username'";
        $qRes = @$this->conn->query($sql);
        $Row = mysqli_fetch_assoc($qRes);

        $userID = $Row['userID'];
        return $userID;
    }

    public function getUserName($username)
    {
        $sql = "SELECT * FROM user WHERE username ='$username'";
        $qRes = @$this->conn->query($sql);
        $Row = mysqli_fetch_assoc($qRes);

        $fullname = $Row['username'];
        return $fullname;
    }

    public function checkDuplicateUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username='$username'";
        $qRes = @$this->conn->query($sql);
        if (mysqli_num_rows($qRes) == 0) {
            return $checkUsername = true;
        } else {
            return $checkUsername = false;
        }
    }

    // Used by CreateUserAcc & CreateStaffAcc
    public function addUserAccount($username, $password, $fullname, $ic, $gender, $dob, $email, $phoneNumber,$userProfile)
    {
        $un = stripslashes($username);
        $n = stripslashes($fullname);

        $sql = "INSERT INTO user(username, password, fullname, ic, gender, dob, email, phoneNumber, userProfile) VALUES( '$un', '$password', '$n', '$ic', '$gender', '$dob', '$email', '$phoneNumber','$userProfile')";
        $qRes = @$this->conn->query($sql);

        if ($qRes === TRUE) {
            return $validation = true;
        } else {
            return $validation = false;
        }
    }

    // Used by ModifyStaffAcc
    public function modifyStaffAcc($userID, $username, $password, $fullname, $ic, $gender, $dob, $email, $phoneNumber, $userProfile)
    {
        
        $sql = "UPDATE user SET ";

        if (!empty($username))
        {
            $sql .= "username = '$username',";
        }

        if (!empty($password))
        {
            $sql .= "password = '$password',";
        }

        if (!empty($fullname))
        {
            $sql .= "fullname = '$fullname',";
        }

        if (!empty($ic))
        {
            $sql .= "ic = '$ic',";
        }


        if (!empty($gender))
        {
            $sql .= "gender = '$gender',";
        }

        if (!empty($dob))
        {
            $sql .= "dob = '$dob',";
        }

        if (!empty($email))
        {
            $sql .= "email = '$email',";
        }

        if (!empty($phoneNumber))
        {
            $sql .= "phoneNumber = '$phoneNumber',";
        }
        // to modify the user Profile of the staff 
        if (!empty($userProfile))
        {
            $sql .= "userProfile = '$userProfile',";
        }
        if (empty($username) and empty($password) and empty($fullname) and empty($ic) and empty($gender) and empty($dob) and empty($email) and empty($phoneNumber) and empty($password) and empty($userProfile))
        {
            return $validation = true;
        }
        // take away comma which is last char in string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE userID = $userID";

        $queryResult = @$this->conn->query($sql);
        if ($queryResult === TRUE)
        {
            return $validation = true;
        }
    }

    // Used by Modify Patient/Nurse/Doctor Acc
    public function modifyUserAcc($userID, $username, $password, $fullname, $gender, $email, $phoneNumber)
    {
        
        $sql = "UPDATE user SET ";

        if (!empty($username))
        {
            $sql .= "username = '$username',";
        }

        if (!empty($password))
        {
            $sql .= "password = '$password',";
        }

        if (!empty($fullname))
        {
            $sql .= "fullname = '$fullname',";
        }


        if (!empty($gender))
        {
            $sql .= "gender = '$gender',";
        }

        if (!empty($email))
        {
            $sql .= "email = '$email',";
        }

        if (!empty($phoneNumber))
        {
            $sql .= "phoneNumber = '$phoneNumber',";
        }
        
        if (empty($username) and empty($password) and empty($fullname) and empty($gender) and empty($email) and empty($phoneNumber) and empty($password))
        {
            return $validation = true;
        }
        // take away comma which is last char in string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE userID = $userID";

        $queryResult = @$this->conn->query($sql);
        if ($queryResult === TRUE)
        {
            return $validation = true;
        }
    }

    // Used by SearchUser
    // Does not search passwords or ICs
    public function searchUser($userId, $userName, $fullname, $gender, $dob, $email, $phoneNumber, $userProfile)
    {
        $sql = "SELECT * FROM user join userProfile ON user.userProfile = userProfile.profileID  WHERE userId IS NOT NULL ";

        if ($userId != null)
        {
            $sql .= "AND userId = '$userId' ";
        }
        if ($userName != null)
        {
            $sql .= "AND username LIKE '%$userName%' ";
        }
        if ($fullname != null)
        {
            $sql .= "AND fullname LIKE '%$fullname%' ";
        }
        if ($gender != null)
        {
            $sql .= "AND gender LIKE '$gender' ";
        }
        if ($dob != null)
        {
            $sql .= "AND dob LIKE '%$dob%' ";
        }
        if ($email != null)
        {
            $sql .= "AND email LIKE '%$email%' ";
        }
        if ($phoneNumber != null)
        {
            $sql .= "AND phoneNumber LIKE '%$phoneNumber%' ";
        }
        if ($userProfile != null)
        {
            $sql .= "AND profileName LIKE '%$userProfile%' ";
        }


        
        $result = @$this->conn->query($sql);
        return $result;
    }

    // Used by all roles XViewAccount
    public function userViewAcc($userId, $userName, $fullname, $gender, $dob, $email, $phoneNumber)
    {
        $sql = "SELECT * FROM user join userProfile ON user.userProfile = userProfile.profileID  WHERE userId IS NOT NULL ";

        if ($userId != null)
        {
            $sql .= "AND userId = '$userId' ";
        }
        if ($userName != null)
        {
            $sql .= "AND username LIKE '%$userName%' ";
        }
        if ($fullname != null)
        {
            $sql .= "AND fullname LIKE '%$fullname%' ";
        }
        if ($gender != null)
        {
            $sql .= "AND gender LIKE '$gender' ";
        }
        if ($dob != null)
        {
            $sql .= "AND dob LIKE '%$dob%' ";
        }
        if ($email != null)
        {
            $sql .= "AND email LIKE '%$email%' ";
        }
        if ($phoneNumber != null)
        {
            $sql .= "AND phoneNumber LIKE '%$phoneNumber%' ";
        }
        
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getName($userID) 
    {
        $sql = "SELECT * FROM user  WHERE userID = '$userID'";
        $result = @$this->conn->query($sql);
        return $result;
    }


    public function getAllUserProfiles()
    {
        $profileArr = array();

        $sql = "SELECT * FROM userprofile";
        $qRes = @$this->conn->query($sql);
        
        while ($row = $qRes->fetch_assoc()) {
            $profileArr[] = $row;
        }

        /*
        while ($row = $qRes->fetch_assoc()) {
            $profileArr[$row['profileID']] = $row["profileName"];
        }
        */

        return $profileArr;
    }

    public function getEmails() 
    {
        $emailsArr = array();
        $sql = "SELECT * FROM user WHERE userProfile = 1";
        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $emailsArr[] = $row;
        }
        
        return $emailsArr;
    }
}