<?php 
  session_start();
  include "../connect.php";
	include "../iconTab.php";
  include "topNavigation.php";

  $DSql = "SELECT * FROM department";
  $deptResult = mysqli_query ($connect, $DSql);

  $SSql = "SELECT * FROM status WHERE stat_ID IN (1, 2)";
  $statResult = mysqli_query ($connect, $SSql);
?>

<style>
  /* Hide Scrollbar */
  ::-webkit-scrollbar {
    display: none;
  }

  .background h1 {
    color: #000;
    font-family: 'Arial';
    font-size: 45px;
    /* text-shadow: 10px 10px 5px black; */
    text-transform: uppercase;
  }

  body {
    background-size: cover;
    background-position: center;
    height: 760px;
    position: relative;
    margin: 0;
  }

  * {
    box-sizing: border-box;
  }

  input[type=text], select, textarea, input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }

  input[type=password], select, textarea, input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }

  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    font-family: Arial;
    font-size: 14px;
  }

  input[type=submit] {
    background-color: #99aabb;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
  }

  input[type=submit]:hover {
    background-color: #FFB450;
  }

  .container {
    border-radius: 10px;
    background-color: #f2f2f2;
    padding: 20px;
    margin-left: 150px;
    margin-right: 150px;
  }

  .container center { 
    color: red;
  }

  .left-col {
    float: left;
    width: 25%;
    margin-top: 6px;
  }

  .right-col {
    float: left;
    width: 75%;
    margin-top: 6px;
  }

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

  .submit-button {
    font-size: 15px;
		width: 100px;
		height: 30px;
		margin: 5px;
  }
</style>

<!DOCTYPE html>
<html>
  <body>
    <!-- NAVIGATION BAR -->
    <nav class="topnav" id="myTopnav">
      <img src="../Images/logo.png">
      <a href="../logoutFunction.php">
        <i class="fa fa-sign-out"></i>
      </a>
      <a href="staffReport.php">
        <i class="fa fa-print"></i>
      </a>
      <a class="active" href="staffRegister.php">
        <i class="fa fa-user-plus"></i>
      </a>
      <a href="searchPage.php">
        <i class="fa fa-home"></i>
      </a>
    </nav>

    <div class="background"><br><br>

      <h1><center>REGISTER</center></h1>

      <br>
      
      <div class="container">

        <form action="staffAdd.php" method="post">
          
          <!-- ID FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sID">* IC / Passport Number:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sID" name="staffID" placeholder="Eg: 010101010101" required>
            </div>
          </div>
            
          <!-- NAME FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sName">* Name:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sName" name="staffName" placeholder="Full Name (as per IC or Passport)" required>
            </div>
          </div>

          <!-- USERNAME FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sUname">* Username:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sUname" name="staffUname" placeholder="" required>
            </div>
          </div>

          <!-- PASSWORD FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sPass">* Password:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sPass" name="staffPass" placeholder="" required>
            </div>
          </div>

          <!-- CONTACT NUMBER FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sContact">* Contact Number:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sContact" name="staffContact" placeholder="Eg: 60123456789" required>
            </div>
          </div>

          <!-- EXTENSION FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sExt">Extension:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sExt" name="staffExt" placeholder="Eg: 1301">
            </div>
          </div>

          <!-- GRADE FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sGrade">* Grade:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sGrade" name="staffGrade" placeholder="Eg: U29" required>
            </div>
          </div>

          <!-- POSITION FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sPosition">* Position:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sPosition" name="staffPosition" placeholder="Eg: Nurse" required>
            </div>
          </div>

          <!-- DEPARTMENT FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sDept">* Department:</label>
            </div>
            <div class="right-col">
              <input list="deptList" id="sDept" name="staffDept" required placeholder="Type here...">
              <datalist id="deptList">
                <?php
                while ($Drow = mysqli_fetch_array($deptResult)) {
                  echo '<option value="' . $Drow['dept_ID'] . ' : ' . $Drow['dept_Name'] . '">';
                }
                ?>
              </datalist>
            </div>
          </div>

          <!-- WARD/CLINIC/UNIT FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sWC">Ward / Clinic / Unit:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sWC" name="staffWC" placeholder="Eg: ICU">
            </div>
          </div>

          <!-- STATUS FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sStat">* Status:</label>
            </div>
            <div class="right-col">
              <select id="sStat" name="staffStat" required>
                <option value="" hidden>- Select -</option>
                <?php
                  while($Srow = mysqli_fetch_array($statResult)) {
                    echo '<option value='.$Srow['stat_ID'].'>'.$Srow['stat_Type'].'</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <!-- DETAILS FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sDetails">Details:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sDetails" name="staffDetails" placeholder="Eg: Contract / Protege Program / Internship / Training">
            </div>
          </div>

          <!-- START DATE FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sSDate">* Start Date:</label>
            </div>
            <div class="right-col">
              <input style="margin-top: 10px;" type="date" id="sStartDate" name="staffStartDate" required>
            </div>
          </div>

          <!-- END DATE FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sEDate">End Date:</label>
            </div>
            <div class="right-col">
              <input style="margin-top: 10px;" type="date" id="sEndDate" name="staffEndDate">
            </div>
          </div>

          <br><br>

          <!-- BUTTON -->
          <div class="row">
            <center>
              <button class="submit-button">Submit</button>
            </center>
          </div>
        
        </form>
      </div>
      <br><br>
    </div>
  </body>
</html>