<?php
    session_start();
    include "../connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sID = $_SESSION['sID'];
        $mRoom = $_POST['mRoom'];
        $mTitle = $_POST['mTitle'];
        $mDate = $_POST['mDate'];
        $sTime = $_POST['sTime'];
        $eTime = $_POST['eTime'];
        $pName = $_POST['pName'];
        $pDept = $_POST['pDept'];
        $pContact = $_POST['pContact'];
        $pNotes = $_POST['pNotes'];

        // Check if the room is available during the selected time slot
        $sql = "SELECT * FROM reservation
                INNER JOIN time ON reservation.time_start = time.time_ID
                WHERE room_ID = '$mRoom' AND reserve_Date = '$mDate' 
                AND (time_Start < '$eTime' AND time_End > '$sTime')";

        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            // The room is already reserved during the selected time slot
            $_SESSION['status'] = "The room is not available at that time.";
            header("location: reservationRegister.php?room_id=$mRoom&time_id=$sTime&date=$mDate");
        } else {
            // Check if the department exists
            $checkDeptQuery = "SELECT * FROM department WHERE department_ID = '$pDept'";
            $checkDeptResult = mysqli_query($connect, $checkDeptQuery);

            if ($checkDeptResult && mysqli_num_rows($checkDeptResult) > 0) {
                // Department exists, fetch the department ID
                $deptData = mysqli_fetch_assoc($checkDeptResult);
                $deptID = $deptData['department_ID'];

                // Insert the reservation into the database
                $register = "INSERT INTO `reservation`(`admin_ID`, `room_ID`, `reserve_Title`, `reserve_Date`, `time_Start`, `time_End`, `reserve_PIC`, `reserve_Contact`, `department_ID`, `reserve_Notes`) 
                            VALUES ('$sID', '$mRoom', '$mTitle', '$mDate', '$sTime', '$eTime', '$pName', '$pContact', '$pDept', '$pNotes')";
                
                $exec = mysqli_query($connect, $register);

                if ($exec) {                    
                    echo '<script>alert("Your reservation has been submitted!");</script>';
                    echo '<script>window.location.href = "dashboardPage.php";</script>';
                } else {
                    $_SESSION['status'] = "An error has occurred!";
                    header("location: reservationRegister.php?room_id=$mRoom&time_id=$sTime&date=$mDate");
                }
            } else {
                // Department does not exist
                $_SESSION['status'] = "The specified department does not exist.";
                header("location: reservationRegister.php?room_id=$mRoom&time_id=$sTime&date=$mDate");
            }
        }
    }
?>
