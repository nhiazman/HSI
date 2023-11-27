<?php
    session_start();
    include "../connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $sID = $_POST['sID'];
        $aName = $_POST['aName'];
        $aContact = $_POST['aContact'];
        $aUsername = $_POST['aUsername'];
        $aPassword = $_POST['aPassword'];
        $aExt = $_POST['aExt'];
        
        $update = "UPDATE `administrator` 
                SET `admin_Name`='$aName',
                    `admin_Contact`='$aContact',
                    `admin_Username`='$aUsername',
                    `admin_Password`='$aPassword', 
                    `admin_Ext`='$aExt'
                WHERE `admin_ID`='$sID' ";

        $exec = mysqli_query($connect, $update);
        
        if($exec) {
            $_SESSION['status'] = "Successfully updated!";
        } else {
            $_SESSION['status'] = "An error has occurred!";
        }   
        header("location: adminEdit.php?id=$sID");
        echo mysqli_error($connect);
    }
?>
