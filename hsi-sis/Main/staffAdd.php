<?php
    session_start();
    include "../connect.php";
    
    if (!isset($_SESSION['admin_ID'])) {
        // Redirect or handle the case when the admin is not logged in.
        echo '<script>alert("Admin not logged in!");</script>';
        echo '<script>window.location.href = "loginPage.php";</script>';
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
        $sStartDate = $_POST['staffStartDate'];
        $sEndDate = $_POST['staffEndDate'];

        // Calculate the end_Date based on opt_ID
        if ($sStat == 1) {
            // If opt_ID is 1, add 100 years to start_Date
            $sEndDate = date('Y-m-d', strtotime($sStartDate . ' +100 years'));
        }
    
        $sql = "SELECT * FROM staff WHERE staff_ID = '".$sID."' limit 1"; 
        $result = mysqli_query($connect, $sql);
 
        if(mysqli_num_rows($result) == 0) {
        
            $register = "INSERT INTO `staff`(`staff_ID`, `staff_Time`, `staff_By`, `staff_Name`, `staff_Username`, `staff_Password`, `staff_Contact`, `staff_Extension`, `staff_Position`, `staff_Grade`, `staff_Department`, `staff_WardClinic`, `staff_Status`, `staff_Details`, `staff_Start`, `staff_End`) 
                        VALUES ('$sID',CURRENT_TIMESTAMP,'$admin_ID','$sName','$sUname','$sPass','$sContact','$sExt','$sPosition','$sGrade','$sDept','$sWC','$sStat','$sDetails','$sStartDate','$sEndDate')";
            
            $exec = mysqli_query($connect, $register);
        
            if ($exec) {
                // After successful staff registration, insert data into the 'Encounter' table
                $encounterSql = "INSERT INTO `encounter`(`enc_Time`,`enc_By`,`enc_Staff`,`enc_Name`,`enc_Username`,`enc_Password`,`enc_Contact`,`enc_Extension`,`enc_Position`,`enc_Grade`,`enc_Department`,`enc_WardClinic`,`enc_Status`,`enc_Details`,`enc_Start`,`enc_End`,`enc_Action`) 
                VALUES (CURRENT_TIMESTAMP,'$admin_ID','$sID','$sName','$sUname','$sPass','$sContact','$sExt','$sPosition','$sGrade','$sDept','$sWC','$sStat','$sDetails','$sStartDate','$sEndDate','Register')";
                
                $encounterExec = mysqli_query($connect, $encounterSql);

                if ($encounterExec) {
                    echo '<script>alert("The staff information has been added!");</script>';
                    echo '<script>window.location.href = "staffRegister.php";</script>';
                    exit;
                } else {
                    echo '<script>alert("An error has occurred!");</script>';
                    echo '<script>window.location.href = "staffRegister.php";</script>';
                    exit;
                }
            } else { 
                echo '<script>alert("An error has occurred!");</script>';
                echo '<script>window.location.href = "staffRegister.php";</script>';
                exit;
            }
        } else {
            echo '<script>alert("The staff ID already exists in the database!");</script>';
            echo '<script>window.location.href = "staffRegister.php";</script>';
            exit;
        }
        header("location: staffRegister.php");
    }
?>