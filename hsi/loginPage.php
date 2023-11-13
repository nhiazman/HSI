<?php
  include "connect.php";
  include "iconTab.php";
  include "topNav.php";
?>

<style>
  /* Hide Scrollbar */
  ::-webkit-scrollbar {
    display: none;
  }

  /* Content */
  .content {
    background: rgba(0, 0, 0, 0);
    color: #f1f1f1;
    width: 90%;
    border-radius:30px 30px 30px 30px;
    justify-content: center;
    align-content: center;
    margin: 0px;
  }

  body {
    background-image: url("Images/7.jpg");
    background-size: cover;
    background-position: center;
    height: 760px;
    position: relative;
    margin: 0;
  }

  * {
    box-sizing: border-box;
  }

  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
  }

  .container {
    border-radius: 10px;
    padding: 0px;
    background-color: #fff;
    border: 1px solid #ccc;
    margin: 50px auto;
    max-width: 400px;
    text-align: center;
    margin-top: 75px;
    opacity: 96%;
  }

  .container center {
    color: red;
  }

  .left-col {
    text-align: right;
    float: left;
    width: 0%;
    margin-top: 16px;
    margin-left: 60px;
  }

  .right-col {
    float: right;
    width: 75%;
    margin-top: 6px;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .left-col, .right-col, input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
  }
      
  input[type=text], input[type=password] {
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 60%;
    box-sizing: border-box;
  }
      
  button[type=submit] {
    background-color: #1A43BF;
    color: #fff;
    padding: 10px;
    border-radius: 20px;
    border-color: black;
    width: 45%;
    cursor: pointer;
    font-family: Arial;
  }
      
  button[type=submit]:hover {
    background-color: #00008B;
  }
</style>

<!DOCTYPE html>
<html>
  <body>    
    <nav class="topnav" id="myTopnav">
      <a class="active" href="loginPage.php">
        <i class="fa fa-sign-in"></i>
      </a>
      <a href="index.php">
        <i class="fa fa-search"></i>
      </a>
    </nav>

    <div class="background"><br><br>

      <div class="container">

        <form name="login" method="post" action="loginFunction.php">

          <br><br>
          <h4 style="font-family: Arial;">STAFF INFORMATION SYSTEM<br>(SIS)</h4>
          <br>
          <img src="Images/logo.png" alt="Company Logo" width="110" height="110">
          <br>

          <font color = "red" >
            <?php
              echo "<br>";
              if(isset($_SESSION["error"])){
                echo $_SESSION["error"];
              }
              echo "<br>";
            ?>
          </font>

          <div class="row">
            <div class="left-col">
              <label for="uname" style="font-family: Arial; font-size: 14px; font-weight: bold;">ID:</label>
            </div>
            <div class="right-col">
              <input type="text" name="sID" placeholder="Enter your ID" required>
            </div>
          </div>
      
          <div class="row">
            <div class="left-col">
              <label for="psw" style="font-family: Arial; font-size: 14px; font-weight: bold;">Password:</label>
            </div>
            <div class="right-col">
              <input type="password" name="psw" placeholder="Enter your password" required>
            </div>
          </div>
            
          <br><br>

          <div class="row">
            <center>
              <button type="submit">LOGIN</button>
              <br><br>
              <!-- <a href="forgotPassword.php" class="forgot-password">Forgot password?</a> -->
              <br><br>
            </center>
          </div>

        </form>
      </div>
    </div>
  </body>
</html>

<?php 
  if(isset($_SESSION["error"])){
	  unset ($_SESSION["error"]);
  }
?>

<script>
  window.onscroll = function() { myFunction() };

  var navbar = document.getElementById("myTopnav");
  var sticky = navbar.offsetTop;

  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky");
    } else {
      navbar.classList.remove("sticky");
    }
  }
</script>