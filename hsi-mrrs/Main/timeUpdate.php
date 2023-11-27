<?php
    session_start();
    include "../connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tID = $_POST['tID'];
        $period = $_POST['tPeriod'];

        $update = "UPDATE `time` SET `time_Period`='$period' WHERE `time_ID`='$tID' ";
        $exec = mysqli_query($connect, $update);

        if ($exec) {
            $_SESSION['status'] = "Successfully updated!";
        } else {
            $_SESSION['status'] = "An error has occurred!";
        }
        header("location: timeEdit.php?id=$tID");
        echo mysqli_error($connect);
    }
?>
