<?php
    session_start();
    include "connect.php";
    
    if (isset($_POST['sID']) && isset($_POST['psw'])) {
        $sID = $_POST['sID'];
        $psw = $_POST['psw'];

        $sql = "SELECT * FROM administrator WHERE admin_ID = '".$sID."' AND admin_Password = '".$psw."' limit 1"; 
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION["admin_ID"] = $sID;
            $_SESSION["adminName"] = $row['admin_Name'];
            $_SESSION["sID"] = $sID;

            header('Location: Main/dashboardPage.php');            
            exit();
        } else {
            $_SESSION["error"] = "Invalid Login!";
            header('location: loginPage.php');
            exit();
        }
    }
?>