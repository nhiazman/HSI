<?php
  session_start();
  include "connect.php";

  if (isset($_POST['sID']) && isset($_POST['psw'])) {
      $uname = $_POST['sID'];
      $pass = $_POST['psw'];

      $sql = "SELECT * FROM administrator WHERE admin_ID = '".$uname."' AND admin_Password = '".$pass."' limit 1"; 
      $result = mysqli_query($connect, $sql);

      if (mysqli_num_rows($result) == 1) {
          // Login successful
          $row = mysqli_fetch_assoc($result);
          $_SESSION["admin_ID"] = $uname; // Set admin_ID in the session
          $_SESSION["username"] = $row['admin_Name'];
          $_SESSION["userID"] = $uname;

          // Redirect to a dashboard or homepage
          header('Location: Main/searchPage.php'); // Change the destination URL as needed
          exit();
      } else {
          // Login failed
          $_SESSION["error"] = "Invalid Login!";
          header('location: loginPage.php'); // Change the destination URL as needed
          exit();
      }
  }
?>
