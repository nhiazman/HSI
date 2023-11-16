<?php
    session_start();
    include "../iconTab.php";
    include "../sideNav.php";
    include "../connect.php";

    $sID = $_SESSION['userID'];
    $Rsql = "SELECT * FROM room WHERE status_ID = 1";
	$roomresult = mysqli_query($connect, $Rsql);
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

    input[type=time]{
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type=checkbox]{
        width: auto;
        padding: auto;
        margin-top: auto;
        border: 1px solid #ccc;
        border-radius: 2px;
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
        margin: 50px;
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

    .button1 {
        font-size: 16px;
        padding: 10px 20px;
        background-color: #007bff; /* Blue background color */
        color: white;
        border: none;
        border-radius: 4px; /* Rounded corners */
        cursor: pointer;
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
</style>

<!DOCTYPE html>
<html>
    <body>
        <div class="background"><br><br>
        
        <h1><center>NEW RESERVATION</center></h1>

        <div class="container">

            <center>
            <?php
                if(isset($_SESSION["status"])){
                echo $_SESSION["status"];
                }
            ?>   
            </center>

            <br>

            <form name="register" method="post" action="reservationAdd.php">
            
            <div class="row">
                <div class="left-col">
                    <label for="MeetT" style= "font-family: Arial; font-size: 14px;">Meeting Title:</label>
                </div>
                <div class="right-col">
                    <input type="text"  name="mTitle" placeholder="Enter Meeting Title.." required>
                </div>
            </div>
            
            <div class="row">
                <div class="left-col">
                    <label for="mRoom" style= "font-family: Arial; font-size: 14px;">Room:</label>
                </div>
                <div class="right-col">
                    <select id="mRoom" name="mRoom" required>
                        <option value="" hidden>--Select One--</option>
                        <?php
                            while($Rrow = mysqli_fetch_array($roomresult)) {
                                $roomId = $Rrow['room_ID'];
                                $roomName = $Rrow['room_Name'];
                                $selected = ($roomId == $_GET['room_id']) ? 'selected' : '';
                                echo '<option value="' . $roomId . '" ' . $selected . '>' . $roomName . '</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="left-col">
                     <label for="mDate" style= "font-family: Arial; font-size: 14px;">Date:</label>
                </div>
                <div class="right-col">
                <?php
                    $selectedDate = isset($_GET['date']) ? $_GET['date'] : '';
                    if ($selectedDate) {
                    $dateComponents = explode('-', $selectedDate);
                    if (count($dateComponents) === 3) {
                        $year = $dateComponents[0];
                        $month = $dateComponents[1];
                        $day = $dateComponents[2];
                        $formattedDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
                        $selectedDate = $formattedDate;
                    }
                    }
                    $currDate = date('Y-m-d'); // Get the current date
                    echo '<input type="date" name="mDate" placeholder="Enter Meeting Date.." min="' . $currDate . '" value="' . $selectedDate . '" required />';
                ?>
                </div>
            </div>
            
            <!-- This Start Time Using Data That Passed Through URL Link -->
            <div class="row">
                <div class="left-col">
                <label for="sTime" style= "font-family: Arial; font-size: 14px;">Starts at:</label>
                </div>
                <div class="right-col">
                <select id="sTime" name="sTime" onchange="updateSecondSelect()" required>
                    <option value="" hidden>--Select One--</option>
                    <?php
                    $selectedTime = $_GET['time_id'];
                    while ($Trow = mysqli_fetch_array($timeresult)) {
                        if ($Trow['time_ID'] != '6' && $Trow['time_ID'] != '10') {
                        $Timerow = date('h:i a', strtotime($Trow['time_Period']));
                            
                        // Check if the current time should be preselected
                        $selected = ($Trow['time_ID'] == $selectedTime) ? 'selected' : '';
                            
                        echo '<option value="' . $Trow['time_ID'] . '" ' . $selected . '>' . $Timerow . '</option>';
                        }
                    }
                    ?>
                </select>
                </div>
            </div>
                        
            <div class="row">
                <div class="left-col">
                <label for="eTime" style= "font-family: Arial; font-size: 14px;">Ends at:</label>
                </div>
                <div class="right-col">
                        <select id="eTime" name="eTime" required>
                            <option value="" hidden>--Select One--</option>
                    <?php
                                mysqli_data_seek($timeresult, 0);
                    while($Trow = mysqli_fetch_array($timeresult)) {
                                    if ($Trow['time_ID'] != '1') {
                        $Timerow = date('h:i a', strtotime($Trow['time_Period']));
                        echo '<option value='.$Trow['time_ID'].'>'.$Timerow.'</option>';
                        }
                    }
                    ?>
                </select>
                </div>
            </div>
            
            <div class="container">
                <div class="button-container">
                    <button class="back-button" id="backButton">Back</button>
                    <button class="button1">Submit</button>
                </div>
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

<script>  
    function CheckmarkFunction() {
        var checkBox = document.getElementById("recEq");
        var text = document.getElementById("linktext");
        if (checkBox.checked == true){
        text.style.display = "block";
        } else {
        text.style.display = "none";
        } 
    }

    document.getElementById("backButton").onclick = function() {
        window.history.back();
    };
</script>