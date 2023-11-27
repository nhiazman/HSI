<?php
    session_start();
    include "../connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $sID = $_POST['sID'];
        $aName = $_POST['aName'];
        $aContact = $_POST['aContact'];
        $aPassword = $_POST['aPassword'];
        $aUsername = $_POST['aUsername'];
        $aExt = $_POST['aExt'];
    
        $sql = "SELECT * FROM administrator WHERE admin_ID = '".$sID."' limit 1"; 
        $result = mysqli_query($connect, $sql);
    
        if(mysqli_num_rows($result) == 0) {
        
        $register = "INSERT INTO `administrator`(`admin_ID`, `admin_Name`, `admin_Username`, `admin_Password`, `admin_Contact`, `admin_Ext`) 
                    VALUES ('$sID', '$aName', '$aUsername', '$aPassword', '$aContact', '$aExt')";
        $exec = mysqli_query($connect, $register);
        
        if($exec) {
            $_SESSION['status'] = "Successfully registered!";
        } else {
            $_SESSION['status'] = "An error has occurred!";
        }
        } else {
        $_SESSION['status'] = "Admin ID already exists in the database!";
        }
        header("location: adminRegister.php");
    }
?>
