<?php
    session_start();
    include "../connect.php";

    $dID = $_GET['id'];

    $sql = "DELETE FROM department WHERE department_ID='$dID'";
    $result = mysqli_multi_query($connect, $sql); 

    if(mysqli_multi_query($connect, $sql)){
        print '<script> alert("Successfully deleted!"); </script>';
        print '<script> window.location.assign("departmentPage.php"); </script>';	  
    }
    else{
        print '<script> alert("Error! Please delete related data first."); </script>';
        print '<script> window.location.assign("departmentPage.php"); </script>';
    }
    echo mysqli_error($connect);
?>