<?php
    session_start();
    include "../connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $wID = $_POST['wID'];
        $sID = $_POST['sID'];

        echo $wID;
        echo $sID;

        $sql = "SELECT * FROM whatsapp WHERE admin_ID = '$sID' AND whatsapp_ID != '$wID' LIMIT 1";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) == 0) {
            $update = "UPDATE `whatsapp` SET `admin_ID`='$sID' WHERE `whatsapp_ID`='$wID'";
            $exec = mysqli_query($connect, $update);

            if ($exec) {
                $_SESSION['status'] = "Successfully updated!";
            } else {
                $_SESSION['status'] = "An error has occurred!";
            }
        } else {
            $_SESSION['status'] = "Contact already exists in the database!";
        }
        header("location: contactEdit.php?id=$wID");
        echo mysqli_error($connect);
    }
?>