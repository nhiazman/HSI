<?php
  session_start();
  include "../connect.php";

  $rID = $_GET['id']; 

  // Perform the reservation deletion
  $deleteQuery = "DELETE FROM reservation WHERE reserve_ID='$rID'";
  $result = mysqli_query($connect, $deleteQuery);

  if ($result) {
      echo '<script> alert("Successfully deleted!"); </script>';
      echo '<script> window.location.assign("dashboardPage.php"); </script>';
  } else {
      echo '<script> alert("Error! Please delete related data first."); </script>';
      echo '<script> window.location.assign("dashboardPage.php"); </script>';
  }

  echo mysqli_error($connect);
?>
