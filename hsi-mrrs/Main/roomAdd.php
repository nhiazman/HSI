<?php
    session_start(); 
    include "../connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $rID = $_POST['rID'];
        $rName = $_POST['rName'];
        $rLoc = $_POST['rLoc'];
        $rStat = $_POST['rStat'];

        echo $rID ;
        echo $rName ;
        echo $rLoc ;
        echo $rStat ;
    
        $sql = "SELECT * FROM room WHERE room_Name = '".$rName."' limit 1"; 
        $result = mysqli_query($connect, $sql);
    
        if(mysqli_num_rows($result) == 0) {
        
        $register = "INSERT INTO `room`(`room_Name`, `room_Location`, `status_ID`) VALUES ('$rName', '$rLoc', '$rStat')";
        $exec = mysqli_query($connect,$register);
        
            if($register) {
                $_SESSION['status'] = "Successfully registered!";
            } else {
                $_SESSION['status'] = "An error has occurred!";
            }
        } else {
            $_SESSION['status'] = "Room already exist in the database!";
        }
        header("location: roomRegister.php");
    }
?>