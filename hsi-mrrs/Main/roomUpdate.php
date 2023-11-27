<?php
    session_start();
    include "../connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rID = $_POST['rID'];
        $rName = $_POST['rName'];
        $rLoc = $_POST['rLoc'];
        $rStat = $_POST['rStat'];
    
        echo $rID;
        echo $rName;
        echo $rLoc;
        echo $rStat;
        
        $sql = "SELECT * FROM room WHERE room_Name = '".$rName."' AND room_ID != '".$rID."' limit 1"; 
        $result = mysqli_query($connect, $sql);
        
        if(mysqli_num_rows($result) == 0) {
            $update = "UPDATE `room` SET `room_Name`='$rName',`room_Location`='$rLoc',`status_ID`='$rStat' WHERE `room_ID`='$rID' ";
            $exec = mysqli_query($connect, $update);
            
            if($exec) {
                $_SESSION['status'] = "Successfully updated!";
            } else {
                $_SESSION['status'] = "An error has occurred!";
            }
        } else {
            $_SESSION['status'] = "Room already exist in the database!";
        }
        header("location: roomEdit.php?id=$rID");
        echo mysqli_error($connect);  
    }
?>