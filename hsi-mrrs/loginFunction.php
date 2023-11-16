<?php
    session_start();
    include "connect.php";
    include "logActivity.php";
    
    if (isset($_POST['sID']) && isset($_POST['psw'])) {
        $uname = $_POST['sID'];
        $pass = $_POST['psw'];

        $sql = "SELECT * FROM administrator WHERE admin_Username = '".$uname."' AND admin_Password = '".$pass."' limit 1"; 
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION["admin_Username"] = $uname;
            $_SESSION["username"] = $row['admin_Name'];
            $_SESSION["userID"] = $uname;

            header('Location: Main/dashboardPage.php');

            // Log the activity
            $activity = "A user has logged in: " . $_SESSION["username"];
            logActivity($uname, 0, $activity);
            
            exit();
        } else {
            $_SESSION["error"] = "Invalid Login!";
            header('location: loginPage.php');
            exit();
        }
    }
?>