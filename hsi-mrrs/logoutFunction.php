<?php 
    session_start();
    include "connect.php";
    include "logActivity.php";
    
    // Log the logout activity
    $adminID = $_SESSION["userID"];
    $activity = "A user has logged out: " . $_SESSION["username"];
    logActivity($adminID, 0, $activity);

    unset($_SESSION);
    session_destroy();
    session_write_close();
    header('location: loginPage.php');
    exit();
?>