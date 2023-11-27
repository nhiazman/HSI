<?php
    session_start(); 
    include "../connect.php";

    $rID = $_GET['id'];

    $sql = "DELETE FROM room WHERE room_ID='$rID'";
    $result = mysqli_multi_query($connect, $sql); 

    if(mysqli_multi_query($connect, $sql)){
        print '<script> alert("Successfully deleted!"); </script>';
        print '<script> window.location.assign("roomPage.php"); </script>';
    } else {
        print '<script> alert("Error! Please delete related data first."); </script>';
        print '<script> window.location.assign("roomPage.php"); </script>';
    }
    echo mysqli_error($connect);
?>
