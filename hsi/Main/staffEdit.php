<?php
    include "../connect.php";

    // Check if the user is logged in and retrieve their admin_ID
    session_start();
    if (!isset($_SESSION['admin_ID'])) {
        // Redirect or handle the case when the admin is not logged in.
        echo '<script>alert("Admin not logged in!");</script>';
        echo '<script>window.location.href = "login.php";</script>';
        exit;
    }

    $admin_ID = $_SESSION['admin_ID'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sID = $_POST['staffID'];
        $sName = $_POST['staffName'];
        $sUname = $_POST['staffUname'];
        $sPass = $_POST['staffPass'];
        $sContact = $_POST['staffContact'];
        $sExt = $_POST['staffExt'];
        $sGrade = $_POST['staffGrade'];
        $sPosition = $_POST['staffPosition'];
        $sDept = $_POST['staffDept'];
        $sWC = $_POST['staffWC'];
        $sStat = $_POST['staffStat'];
        $sDetails = $_POST['staffDetails'];
        $sMod = $_POST['staffMod'];
        $sStartDate = $_POST['staffStartDate'];
        $sEndDate = $_POST['staffEndDate'];

        // Check if staffTime is present in the $_POST data
        $sTime = isset($_POST['staffTime']) ? $_POST['staffTime'] : null;

        // Calculate the end_Date based on sStat
        if ($sStat == 1) {
            $sEndDate = date('Y-m-d', strtotime($sStartDate . ' +100 years'));
        }

        // Check if staff_Modify is equal to 1
        $staffModifyIsOne = $sMod == 1;

        // Create the SQL update query
        $update = "UPDATE `staff` 
                SET `staff_Name`='$sName',
                `staff_Username`='$sUname',
                `staff_Password`='$sPass',
                `staff_Contact`='$sContact',
                `staff_Extension`='$sExt',
                `staff_Grade`='$sGrade',
                `staff_Position`='$sPosition',
                `staff_Department`='$sDept',
                `staff_WardClinic`='$sWC',
                `staff_Status`='$sStat',
                `staff_Details`='$sDetails',
                `staff_Modify`='$sMod',
                `staff_Start`='$sStartDate',
                `staff_End`='$sEndDate'"; // Add staff_By to set the admin ID

        // Update staff_Time only if staff_Modify is equal to 1
        if ($staffModifyIsOne) {
            $update .= ", `staff_Time` = CURRENT_TIMESTAMP";
            $update .= ", `staff_By`='$admin_ID'";
        }

        $update .= " WHERE `staff_ID`='$sID'";

        // Execute the update query
        $exec = mysqli_query($connect, $update);

        if ($exec) {
            // Insert the update action into the 'encounter' table
            $encounterSql = "INSERT INTO `encounter`(`enc_Time`,`enc_By`,`enc_Staff`,`enc_Name`,`enc_Username`,`enc_Password`,`enc_Contact`,`enc_Extension`,`enc_Position`,`enc_Grade`,`enc_Department`,`enc_WardClinic`,`enc_Status`,`enc_Details`,`enc_Modify`,`enc_Start`,`enc_End`,`enc_Action`) 
                VALUES (CURRENT_TIMESTAMP,'$admin_ID','$sID','$sName','$sUname','$sPass','$sContact','$sExt','$sPosition','$sGrade','$sDept','$sWC','$sStat','$sDetails','$sMod','$sStartDate','$sEndDate','Modify')";

            $encounterExec = mysqli_query($connect, $encounterSql);

            if ($encounterExec) {
                echo '<script>alert("The staff information has been updated!");</script>';
                echo '<script>window.location.href = "staffView.php?staff_ID=' . $sID . '";</script>';
                exit;
            } else {
                echo '<script>alert("An error has occurred while recording the update action!");</script>';
                echo '<script>window.location.href = "staffUpdate.php";</script>';
                exit;
            }
        } else {
            echo '<script>alert("An error has occurred while updating the staff information!");</script>';
            echo '<script>window.location.href = "staffUpdate.php";</script>';
            exit;
        }
    }
?>
