<?php
    include "../connect.php";

    $tID = $_GET['id'];

    $sql = "DELETE FROM time WHERE time_ID='$tID'";
    $result = mysqli_multi_query($connect, $sql); 

    if (mysqli_multi_query($connect, $sql)) {
        print '<script> alert("Successfully deleted!"); </script>';
        print '<script> window.location.assign("timePage.php"); </script>';
    } else {
        print '<script> alert("Error! Please delete related data first."); </script>';
        print '<script> window.location.assign("timePage.php"); </script>';
    }
    echo mysqli_error($connect);
?>
