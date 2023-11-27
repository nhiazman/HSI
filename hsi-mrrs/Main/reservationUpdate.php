<?php
    session_start(); 
    include "../connect.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rID = $_POST['rID'];
        $sID = $_POST['sID'];
        $rTitle = $_POST['rTitle'];
        $rRoom = $_POST['rRoom'];
        $rDate = $_POST['rDate'];
        $sTime = $_POST['rSTime'];
        $eTime = $_POST['rETime'];
        $rPIC = $_POST['rPIC'];
        $rDept = $_POST['rDept'];
        $rContact = $_POST['rContact'];
        $rNotes = $_POST['rNotes'];

        if ($eTime <= $sTime) {
            $_SESSION['status'] = "Please adjust the meeting Start time and End time";
            header("location: reservationEdit.php?id=$rID");
        } else { 
            $sql = "SELECT * FROM reservation
                    INNER JOIN time ON reservation.time_Start = time.time_ID
                    WHERE room_ID = '$rRoom' 
                    AND reserve_Date = '$rDate'
                    AND (time_Start < '$eTime' AND time_End > '$sTime')
                    AND reserve_ID != '$rID'";

            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) == 0) {
                $update = "UPDATE `reservation` 
                    SET `reserve_Date`='$rDate',
                        `admin_ID`='$sID',
                        `time_Start`='$sTime',
                        `time_End`='$eTime',
                        `room_ID`='$rRoom',
                        `reserve_Title`='$rTitle', 
                        `reserve_Contact`='$rContact',
                        `reserve_PIC`='$rPIC',
                        `department_ID`='$rDept',
                        `reserve_Notes`='$rNotes'
                    WHERE `reserve_ID`='$rID' ";
                
                $exec = mysqli_query($connect, $update);

                if ($exec) {
                    $_SESSION['status'] = "Successfully updated!";
                } else {
                    $_SESSION['status'] = "An error has occurred!";
                }
            } else {
                $_SESSION['status'] = "Room is not available at that time.";
            }

            header("location: reservationEdit.php?id=$rID");
            echo mysqli_error($connect);
        }
    }
?>