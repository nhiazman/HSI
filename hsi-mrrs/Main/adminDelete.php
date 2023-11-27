<?php
    session_start();
    include "../connect.php";

    $sID = $_GET['id'];

    $sql = "DELETE FROM administrator WHERE admin_ID='$sID'";
    $result = mysqli_multi_query($connect, $sql); 

    if(mysqli_multi_query($connect, $sql)){
        print '<script> alert("Successfully deleted!"); </script>';
        print '<script> window.location.assign("adminPage.php"); </script>';
    }
    else{
        print '<script> alert("Error! Please delete related data first."); </script>';
        print '<script> window.location.assign("adminPage.php"); </script>';
    }
    echo mysqli_error($connect);
?>
