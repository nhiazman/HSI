<?php
  session_start();
  include "../connect.php";
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sID = $_POST['sID'];

    $sql = "SELECT * FROM whatsapp WHERE admin_ID = '$sID' LIMIT 1"; 
    $result = mysqli_query($connect, $sql);
 
    if (mysqli_num_rows($result) == 0) {
        $register = "INSERT INTO `whatsapp`(`admin_ID`) VALUES ('$sID')";
        $exec = mysqli_query($connect, $register);
      
        if ($exec) {
            $_SESSION['status'] = "Successfully registered!";
        } else {
            $_SESSION['status'] = "An error has occurred!";
        }
    } else {
        $_SESSION['status'] = "Contact already exists in the database!";
    }    
    header("location: contactRegister.php");
  }
?>