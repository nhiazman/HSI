<?php   
  session_start(); 
  include "../iconTab.php";
  include "../sideNav.php";
  include "../connect.php";
  
  $rID = $_GET['id'];
  $sql = "SELECT 
		reserve_ID, 
    reserve_Title, 
		reserve_Date,
    reserve_PIC,
    reserve_Contact,
    reserve_Notes,
		reservation.admin_ID,		 
		reservation.room_ID,
    reservation.time_Start, 
    reservation.time_End,
		reservation.department_ID,
    administrator.admin_Name,
    room.room_Name,
    department.department_Name,
		time.time_ID,
		(SELECT time_Period FROM time WHERE time_Start = time_ID) AS startTime, 
		(SELECT time_Period FROM time WHERE time_End = time_ID) AS endTime 
		FROM reservation 
		LEFT JOIN room on reservation.room_ID = room.room_ID 
		LEFT JOIN administrator on reservation.admin_ID = administrator.admin_ID 
		LEFT JOIN department on reservation.department_ID = department.department_ID 
		LEFT JOIN time on reservation.time_Start = time.time_ID
		WHERE reserve_ID = '$rID'";
				  
  $result = mysqli_query($connect,$sql);  
  
  foreach($result as $row) {
		$rID = $row['reserve_ID'];
		$sID = $row['admin_ID'];
		$rDate = $row['reserve_Date'];
		$rStart = $row['startTime'];
		$rStartID = $row['time_Start'];
		$rEnd = $row['endTime'];
		$rEndID = $row['time_End'];
		$rRoom = $row['room_Name'];
		$rRoomID = $row['room_ID'];
		$rAdmin = $row['admin_Name'];
		$rDept = $row['department_Name'];
		$rDeptID = $row['department_ID'];
    $rTitle = $row['reserve_Title'];
    $rPIC = $row['reserve_PIC'];
    $rContact = $row['reserve_Contact'];
    $rNotes = $row['reserve_Notes'];
  }   
	
	$RMsql = "SELECT * FROM room WHERE status_ID = 1";
	$roomresult = mysqli_query($connect, $RMsql);

  $Dsql = "SELECT * FROM department ORDER BY department_ID ASC";
	$deptresult = mysqli_query($connect, $Dsql);
	
  $Tsql = "SELECT * FROM time ORDER BY time_Period ASC";
  $timeresult = mysqli_query($connect, $Tsql);
  
  $currDate = date('Y-m-d');
?>

<style>
  /* Hide Scrollbar */
  ::-webkit-scrollbar {
    display: none;
  }

  .background h1 {
    color: #fff; 
    font-family: 'Barlow'; 
    font-size: 60px; 
    text-shadow: 1px 1px 4px black;
    text-transform: uppercase;
  }

  /* Content */
  .content {
    bottom: 0;
    background: rgba(0, 0, 0, 0);
    color: #f1f1f1;
    width: 98%;
    border-radius:30px 30px 30px 30px;
    justify-content: center;
    align-content: center;
    margin: 0px 20px;
  }

  body {
    background-image: url("../Images/7.jpg");
    background-size: cover;
    background-position: center;
    height: 760px;
    position: relative;
    margin: 0;
    margin-left: 200px;
  } 

  * {
    box-sizing: border-box;
  }

  input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }

  input[type=date]{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
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
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    margin:50px;
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

  /* Style the back button */
  .back-button {
    background-color: #ddd; /* Gray */
    color: black;
    border: none;
    font-size: 16px;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
  }
        
  /* Add hover effect */
  .back-button:hover {
    background-color: #A9A9A9; /* Darker gray on hover */
    color: black;
  }

  /* Center the buttons horizontally */
  .button-container {
    display: flex;
    justify-content: center;
  }

  .button-container button {
    margin: 0 10px; /* Add spacing between the buttons */
  }

  .update-button {
    font-size: 16px;
    padding: 10px 20px;
    background-color: #007bff; /* Blue background color */
    color: white;
    border: none;
    border-radius: 4px; /* Rounded corners */
    cursor: pointer;
  }
</style>

<!DOCTYPE html>
<html>
  <body>
    <div class="background"><br><br>
      
      <h1><center>UPDATE RESERVATION</center></h1>

      <div class="container">

        <center>
          <?php
            if(isset($_SESSION["status"])){
              echo $_SESSION["status"];
            }
          ?>   
        </center>

        <br>

        <form name="register" method="post" action="reservationUpdate.php">
		
		      <input type="hidden"  name="rID" placeholder="Reservaton ID" required value="<?= $rID;?>" readonly/>

          <div class="row">
            <div class="left-col">
              <label for="sID" style= "font-family: Arial; font-size: 14px;">Administrator ID:</label>
            </div>
            <div class="right-col">
             <input style="background-color: #f0f0f0; color: #808080; cursor: not-allowed;" type="text" name="sID" placeholder="Enter meeting title" required value="<?= $sID;?>" readonly/>
            </div>
          </div>

          <div class="row">
            <div class="left-col">
              <label for="rTitle" style= "font-family: Arial; font-size: 14px;">Meeting Title:</label>
            </div>
            <div class="right-col">
             <input type="text" name="rTitle" placeholder="Enter meeting title" required value="<?= $rTitle;?>"/>
            </div>
          </div>

          <div class="row">
            <div class="left-col">
              <label for="rRoom" style= "font-family: Arial; font-size: 14px;">Room:</label>
            </div>
            <div class="right-col">
              <select id="rRoom" name="rRoom">
                <?php
                  echo "<option value='$rRoomID' hidden>$rRoom</option>";      
                  while($Rrow = mysqli_fetch_array($roomresult)) {
                    echo '<option value='.$Rrow['room_ID'].'>'.$Rrow['room_Name'].'</option>';
                  }
                ?>
              </select>
            </div>		  
          </div>

          <div class="row">
            <div class="left-col">
              <label for="rDate" style= "font-family: Arial; font-size: 14px;">Date:</label>
            </div>
            <div class="right-col">
             <input type="date"  name="rDate" placeholder="Enter Staff name.." min="<?php echo $currDate; ?>" required value="<?= $rDate;?>"/>
            </div>
          </div>
		  
          <div class="row">
            <div class="left-col">
              <label for="rSTime" style= "font-family: Arial; font-size: 14px;">Starts at:</label>
            </div>
            <div class="right-col">
              <select id="rSTime" name="rSTime">
                <?php
                  $startTime = date('h:i a', strtotime($rStart));
                  echo "<option value='$rStartID' hidden>$startTime</option>";
                  while($Trow = mysqli_fetch_array($timeresult)) {
				            $Timerow = date('h:i a', strtotime($Trow['time_Period']));
                    echo '<option value='.$Trow['time_ID'].'>'.$Timerow.'</option>';
                  }
                ?>
              </select>
            </div>
          </div>		  
       		  		  
          <div class="row">
            <div class="left-col">
              <label for="rETime" style= "font-family: Arial; font-size: 14px;">Ends at:</label>
            </div>
            <div class="right-col">
              <select id="rETime" name="rETime">
                <?php
				          $endTime = date('h:i a', strtotime($rEnd));
                  echo "<option value='$rEndID' hidden>$endTime</option>";
                  mysqli_data_seek($timeresult, 0);
                  while($Trow = mysqli_fetch_array($timeresult)) {
					          $Timerow = date('h:i a', strtotime($Trow['time_Period']));
                    echo '<option value='.$Trow['time_ID'].'>'.$Timerow.'</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="left-col">
              <label for="rPIC" style= "font-family: Arial; font-size: 14px;">Person in-Charge:</label>
            </div>
            <div class="right-col">
             <input type="text" name="rPIC" placeholder="Enter PIC name" required value="<?= $rPIC;?>"/>
            </div>
          </div>

          <div class="row">
            <div class="left-col">
                <label for="rDept" style= "font-family: Arial; font-size: 14px;">Department:</label>
            </div>
            <div class="right-col">
              <select id="rDept" name="rDept">
                <?php
                  echo "<option value='$rDeptID' hidden>$rDept</option>";      
                  while($Drow = mysqli_fetch_array($deptresult)) {
                    echo '<option value='.$Drow['department_ID'].'>'.$Drow['department_Name'].'</option>';
                  }
                ?>
              </select>
            </div>
          </div>
          
          <div class="row">
            <div class="left-col">
              <label for="rContact" style= "font-family: Arial; font-size: 14px;">PIC Contact:</label>
            </div>
            <div class="right-col">
             <input type="text" name="rContact" placeholder="Enter PIC contact" required value="<?= $rContact;?>"/>
            </div>
          </div>

          <div class="row">
            <div class="left-col">
              <label for="rNotes" style= "font-family: Arial; font-size: 14px;">PIC Notes:</label>
            </div>
            <div class="right-col">
             <input type="text" name="rNotes" placeholder="Enter PIC notes" value="<?= $rNotes;?>"/>
            </div>
          </div>
         
          <br><br> 

          <div class="row">
            <center>
            <input class="back-button" name="cancel" type="button" value="Back" onclick ='location.href="dashboardPage.php"'>
              <button class="update-button">Update</button><br>
            </center>
          </div>

        </form> 
      </div>
    </div>
  </body>
</html>

<?php 
  if(isset($_SESSION["status"])){
    unset ($_SESSION["status"]);
  }
?>