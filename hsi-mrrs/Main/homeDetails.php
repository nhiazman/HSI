<?php
    session_start(); 
    include "../iconTab.php";
    include "../sideNav.php";
    include "../connect.php"; 

    if (isset($_GET['date'])) {
        $selectedDate = $_GET['date'];

        // Fetch all the rooms
        $roomsSql = "SELECT * FROM room WHERE status_ID = 1";
        $roomsResult = mysqli_query($connect, $roomsSql);
    }
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

    .background h2 {
        color: #fff; 
        font-family: 'Arial'; 
        font-size: 25px; 
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

	.myTable { 
		table-layout: fixed ;
		width: 90% ;
		background: white; 
		border-radius: 20px 20px 0px 0px;
		font-family: Verdana, sans-serif;
		font-size: 14px;
		color: black;
		text-align: center;
	}

	.myTable th { 
		font-family: Verdana, sans-serif;
		text-shadow: 1px 1px 4px black;
		font-size: 13px;
		height: 30px;
		letter-spacing: 0.05em;
		background-color: #D21404;
		color: white;
		text-align: center;
	}
	 
	.myTable td, .myTable th { 
		padding: 5px;
		border: 1px solid #616161; 
		overflow-wrap: break-word;
		word-wrap: break-word;
		text-align: center;
	}

    .custom-button {
        margin-top: 10px; /* Add margin to the top */
        margin-bottom: 10px; /* Add margin to the bottom */
        padding: 5px 10px;
    }

     /* Center-align the button container */
    .button-container {
        text-align: center;
        margin-top: 20px;
    }
        
    /* Style the back button */
    .back-button {
        background-color: #f1f1f1; /* Gray */
        color: black;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
        
    /* Add hover effect */
    .back-button:hover {
        background-color: #ddd; /* Darker gray on hover */
        color: black;
    }
</style>

<!DOCTYPE html>
<html>
    <body>
        <!-- Background -->
        <div class="background"><br><br>

            <h1><center>DETAILS</center></h1>
            <h2><center><?php echo date('d-m-Y', strtotime($selectedDate)); ?></center></h2>

            <?php 
                if (mysqli_num_rows($roomsResult) > 0) { 
            ?>

            <center>
                <table id="room" class="myTable">
                    <tr>
                        <th style="border-radius: 20px 0px 0px 0px">ROOM</th>
                        <th>LOCATION</th>
                        <th>STATUS</th>
                        <th style="border-radius: 0px 20px 0px 0px">ACTION</th>
                    </tr>
            <center>

            <?php 
                while ($row = mysqli_fetch_assoc($roomsResult)) { 
            ?>

            <?php
                $roomID = $row['room_ID'];
                $roomName = $row['room_Name'];
                $roomLocation = $row['room_Location'];


                // Query to retrieve reservations for the selected room and date
                $reservationSql = "SELECT time_Start, time_End FROM reservation
                WHERE room_ID = $roomID
                AND reserve_Date = '$selectedDate'";
                $reservationResult = mysqli_query($connect, $reservationSql);

                // Initialize a variable to store the total booked hours
                $totalBookedHours = 0;

                while ($reservationData = mysqli_fetch_assoc($reservationResult)) {
                    $timeStart = $reservationData['time_Start'];
                    $timeEnd = $reservationData['time_End'];
    
                    // Calculate the duration in hours for the current reservation
                    $duration = $timeEnd - $timeStart;
    
                     // Check if the reservation overlaps with the lunch break
                    if ($timeStart <= 6 && $timeEnd >= 7) {
                        // Exclude the time during the lunch break (1pm-2pm)
                        $duration -= min($timeEnd, 7) - max($timeStart, 6);
                    }
    
                    // Add the duration to the total booked hours
                    $totalBookedHours += $duration;
                }
    
                // Check the reservation status of the room
                $reservationSql = "SELECT COUNT(*) AS totalReservations
                                FROM reservation
                                WHERE reserve_Date = '$selectedDate'
                                AND room_ID = $roomID";
                $reservationResult = mysqli_query($connect, $reservationSql);
                $reservationData = mysqli_fetch_assoc($reservationResult);
                $totalReservations = $reservationData['totalReservations'];
                $roomStatus = '';
                if ($totalReservations == 0) {
                    $roomStatus = 'Available';
                    $statusColor = 'green';
                } elseif ($totalBookedHours >= 8) {
                    $roomStatus = 'Fully Reserved';
                    $statusColor = 'red';
                } else {
                    $roomStatus = 'Partially Reserved';
                    $statusColor = '#FCA510';
                } 
            ?>

                <tr style='color:black; font-family: Arial, Helvetica, sans-serif;'>
                    <td style="font-weight:bold;"><?php echo $roomName; ?></td>
                    <td><?php echo $roomLocation; ?></td>
                    <td style="color: <?php echo $statusColor; ?>; font-weight: bold; font-family: Arial; font-size: 14px;"><?=$roomStatus;?></td>
                    <td>
                        <button class="custom-button" onclick="location.href='homeView.php?room_id=<?php echo $roomID; ?>&date=<?php echo $selectedDate; ?>'">View Available Slot</button>
                    </td>
                </tr>

            <?php 
            } 
            ?>

            </center>
            </table>
            </center>

            <?php 
            } else { 
            ?>
                <p>No rooms found.</p>
            
            <?php 
            } 
            ?>
        </div>
    </body>   
    <div class="button-container">
        <button class="back-button" id="backButton">Back</button>
    </div>
</html>

<script>
    // JavaScript function to handle the back button click event
    document.getElementById("backButton").onclick = function() {
        // Go back to the previous page in the browser's history
        window.history.back();
    };
</script>