<?php
    session_start();
    include "../connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $sID = $_SESSION['sID'];
        $aName = $_POST['aName'];
        $aContact = $_POST['aContact'];
        $aUsername = $_POST['aUsername'];
        $aPassword = $_POST['aPassword'];
        $aExt = $_POST['aExt'];
    
        echo $sID;
        echo $aName;
        echo $aContact;
        echo $aUsername;
        echo $aPassword;
        echo $aExt;
    
        $update = "UPDATE `administrator` 
                SET `admin_Name`='$aName',
                `admin_Contact`='$aContact',
                `admin_Username`='$aUsername',
                `admin_Ext`='$aExt',
                `admin_Password`='$aPassword'
                WHERE `admin_ID`='$sID' ";
        $exec = mysqli_query($connect, $update);
            
        if($exec) {
            $_SESSION['status'] = "Successfully updated!";
        }
        else {
            $_SESSION['status'] = "An error has occurred!";
        }
        
        header("location: profileUpdate.php?id=$sID");
        echo mysqli_error($connect);
    }
?>