<?php 
  include "../connect.php";
	include "../iconTab.php";
  include "topNavigation.php";
  session_start();

  if (isset($_GET['staff_ID'])) {
    $staff_ID = $_GET['staff_ID'];

    $sql = "SELECT staff.*, department.dept_Name, status.stat_Type, modify.mod_Type
            FROM staff
            LEFT JOIN department ON staff.staff_Department = department.dept_ID
            LEFT JOIN status ON staff.staff_Status = status.stat_ID
            LEFT JOIN modify ON staff.staff_Modify = modify.mod_ID
            WHERE staff.staff_ID = '$staff_ID'";
    $result = mysqli_query($connect, $sql);
  
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      $sID = $row['staff_ID'];
      $sName = $row['staff_Name'];
      $sUname = $row['staff_Username'];
      $sPass = $row['staff_Password'];
      $sContact = $row['staff_Contact'];
      $sExt = $row['staff_Extension'];
      $sPosition = $row['staff_Position'];
      $sGrade = $row['staff_Grade'];
      $sDept = $row['dept_Name'];
      $sWC = $row['staff_WardClinic'];
      $sStat = $row['staff_Status'];
      $sDetails = $row['staff_Details'];
      $sModify = $row['staff_Modify'];
      $sStartDate = $row['staff_Start'];
      $sEndDate = $row['staff_End'];

    } else {
      echo "Staff information not found.";
    }
  } else {
    echo "Staff ID is not provided in the URL.";
  }

  $DSql = "SELECT * FROM department";
  $deptResult = mysqli_query ($connect, $DSql);

  $SSql = "SELECT * FROM status";
  $statResult = mysqli_query ($connect, $SSql);

  $MSql = "SELECT * FROM modify";
  $modResult = mysqli_query ($connect, $MSql);
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

  .custom-button {
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
      <a href="searchPage.php">
        <i class="fa fa-home"></i>
      </a>
    </nav>

    <div class="background"><br><br>

      <h1><center>UPDATE</center></h1>

      <br>
      
      <div class="container">

        <form action="staffEdit.php" method="post">
          
          <!-- ID FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sID">* IC / Passport Number:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sID" name="staffID" required value="<?= $sID;?>"/>
            </div>
          </div>
            
          <!-- NAME FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sName">* Name:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sName" name="staffName" required value="<?= $sName;?>"/>
            </div>
          </div>

          <!-- USERNAME FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sUname">* Username:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sUname" name="staffUname" required value="<?= $sUname;?>"/>
            </div>
          </div>

          <!-- PASSWORD FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sPass">* Password:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sPass" name="staffPass" required value="<?= $sPass;?>"/>
            </div>
          </div>

          <!-- CONTACT NUMBER FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sContact">* Contact Number:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sContact" name="staffContact" required value="<?= $sContact;?>"/>
            </div>
          </div>

          <!-- EXTENSION FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sExt">Extension:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sExt" name="staffExt" value="<?= $sExt;?>"/>
            </div>
          </div>

          <!-- GRADE FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sGrade">* Grade:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sGrade" name="staffGrade" required value="<?= $sGrade;?>"/>
            </div>
          </div>

          <!-- POSITION FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sPosition">* Position:</label>
            </div>
            <div class="right-col">
              <input type="text" id="sPosition" name="staffPosition" required value="<?= $sPosition;?>"/>
            </div>
          </div>

          <!-- DEPARTMENT FIELD -->
          <div class="row">
            <div class="left-col">
                <label for="sDept">* Department:</label>
            </div>
            <div class="right-col">
            <input list="deptList" id="sDept" name="staffDept" required value="<?= $sDept; ?>" placeholder="Type here...">
                <datalist id="deptList">
                    <?php
                        while ($Drow = mysqli_fetch_array($deptResult)) {
                          $deptID = $Drow['dept_ID'];
                          $deptName = $Drow['dept_Name'];
                          // Check if this option matches the staff's department, and if so, mark it as selected
                          $selected = ($deptName == $sDept) ? 'selected' : '';
                          echo '<option value="' . $deptID . ' : ' . $deptName . '"</option>';
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
              <input type="text" id="sWC" name="staffWC" value="<?= $sWC;?>"/>
            </div>
          </div>

          <!-- STATUS FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sStat">* Status:</label>
            </div>
            <div class="right-col">
              <select id="sStat" name="staffStat" required>
                <?php
                  while($Srow = mysqli_fetch_array($statResult)) {
                    $statID = $Srow['stat_ID'];
                    $statType = $Srow['stat_Type'];
           
                    $selected = ($statID == $sStat) ? 'selected' : '';
          
                    echo '<option value="' . $statID . '" ' . $selected . '>' . $statType . '</option>';
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
              <input type="text" id="sDetails" name="staffDetails" value="<?= $sDetails;?>"/>
            </div>
          </div>

          <!-- MODIFY FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sMod">* Modify Type:</label>
            </div>
            <div class="right-col">
              <select id="sMod" name="staffMod" required>
                <option value="" hidden>- Select -</option>
                <?php
                  while($Mrow = mysqli_fetch_array($modResult)) {
                    $modID = $Mrow['mod_ID'];
                    $modType = $Mrow['mod_Type'];
          
                    $selected = ($modID == $sMod) ? 'selected' : '';
          
                    echo '<option value="' . $modID . '" ' . $selected . '>' . $modType . '</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <!-- START DATE FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sSDate">* Start Date:</label>
            </div>
            <div class="right-col">
              <input style="margin-top: 10px;" type="date" id="sStartDate" name="staffStartDate" required value="<?= $sStartDate;?>"/>
            </div>
          </div>

          <!-- END DATE FIELD -->
          <div class="row">
            <div class="left-col">
              <label for="sEDate">End Date:</label>
            </div>
            <div class="right-col">
              <input style="margin-top: 10px;" type="date" id="sEndDate" name="staffEndDate" value="<?= $sEndDate;?>"/>
            </div>
          </div>

          <br><br>

          <!-- BUTTON -->
          <div class="row">
            <center>
              <button class="custom-button" type="button" onclick='location.href="staffView.php?staff_ID=<?php echo $sID; ?>"'>Back</button>
              <button class="custom-button" id="updateButton">Update</button>
            </center>
          </div>
        
        </form>
      </div>
      <br><br>
    </div>
  </body>
</html>
