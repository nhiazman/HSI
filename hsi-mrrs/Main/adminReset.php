<?php
    session_start();
    include "../connect.php";

    $sID = $_GET['id'];

    $sql = "UPDATE `administrator` SET `admin_Password`=`admin_ID` WHERE `admin_ID`='$sID'";
    $result = mysqli_multi_query($connect, $sql); 

    if(mysqli_multi_query($connect,$sql)){
        print '<script> alert("The user password has been reset!"); </script>';
        print '<script> window.location.assign("adminPage.php"); </script>';
    }
    else{ 
        print '<script> alert("An error has occurred!"); </script>';
        print '<script> window.location.assign("adminPage.php"); </script>';
    }
    echo mysqli_error($connect);
?>
