<?php
    session_start();
    include "../connect.php";
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dID = $_POST['dID'];
        $dName = $_POST['dName'];
    
        echo $dID;
        echo $dName; 
        
        $sql = "SELECT * FROM department WHERE department_Name = '".$dName."' AND department_ID != '".$dID."' limit 1"; 
        $result = mysqli_query($connect, $sql);
        
        if(mysqli_num_rows($result) == 0) {
            $update = "UPDATE `department` SET `department_Name`='$dName' WHERE `department_ID`='$dID' ";
            $exec = mysqli_query($connect, $update);
            
            if($exec) {
                $_SESSION['status'] = "Successfully updated!";
            } else {
                $_SESSION['status'] = "An error has occurred!";
            } 
        } else {
            $_SESSION['status'] = "Department already exist in the database!";
        }
        header("location: departmentEdit.php?id=$dID");
        echo mysqli_error($connect);
    }
?>