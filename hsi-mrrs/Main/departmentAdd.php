<?php
    session_start();
    include "../connect.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dID = $_POST['dID'];
        $dName = $_POST['dName'];

        $sql = "SELECT * FROM department WHERE department_Name = '".$dName."' LIMIT 1"; 
        $result = mysqli_query($connect, $sql);
    
        if (mysqli_num_rows($result) == 0) {
            $register = "INSERT INTO `department`(`department_Name`) VALUES ('$dName')";
            $exec = mysqli_query($connect, $register);
            
            if ($exec) {
                $_SESSION['status'] = "Successfully registered!";
            } else {
                $_SESSION['status'] = "An error has occurred!";
            }
        } else {
            $_SESSION['status'] = "Department ID already exists in the database!";
        }        
        header("location: departmentRegister.php");
    }
?>