<?php
    session_start();
    include "../connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tID = $_POST['tID'];
        $tPeriod = $_POST['tPeriod'];

        $sql = "SELECT * FROM time WHERE time_Period = '".$tPeriod."' LIMIT 1"; 
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) == 0) {
        $register = "INSERT INTO `time`(`time_Period`) VALUES ('$tPeriod')";
        $exec = mysqli_query($connect, $register);

        if ($exec) {
            $_SESSION['status'] = "Successfully registered!";
        } else {
            $_SESSION['status'] = "An error has occurred!";
        }
        } else {
        $_SESSION['status'] = "Time already exists in the database!";
        }

        header("location: timeRegister.php");
    }
?>
