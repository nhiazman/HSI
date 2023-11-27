<?php
    session_start();
    include "../connect.php";

    $wID = $_GET['id'];

    $sql = "DELETE FROM whatsapp WHERE whatsapp_ID='$wID'";
    $result = mysqli_multi_query($connect, $sql); 

    if ($result) {
        echo '<script> alert("Successfully deleted!"); </script>';
        echo '<script> window.location.assign("contactPage.php"); </script>';	  
    } else {
        echo '<script> alert("Error! Please delete related data first."); </script>';
        echo '<script> window.location.assign("contactPage.php"); </script>';
    }
    echo mysqli_error($connect);
?>