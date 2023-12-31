<?php
    session_start();
    include "../iconTab.php";
    include "../sideNav.php";
    include "../connect.php";  

    if (isset($_GET['room_id']) && isset($_GET['date'])) {
        $mRoom = $_GET['room_id'];
        $selectedDate = $_GET['date'];

        // Fetch room name
        $roomNameSql = "SELECT room_Name FROM room WHERE room_ID = $mRoom";
        $roomNameResult = mysqli_query($connect, $roomNameSql);
        $roomNameData = mysqli_fetch_assoc($roomNameResult);
        $roomName = $roomNameData['room_Name'];

        // Fetch all time slots
        $timesSql = "SELECT time_ID, TIME_FORMAT(time_Period, '%h:%i %p') AS formatted_time FROM time";
        $timesResult = mysqli_query($connect, $timesSql);
        $timeSlots = array();

        // Initialize time slots array
        while ($row = mysqli_fetch_assoc($timesResult)) {
            $timeSlots[$row['time_ID']] = $row['formatted_time'];
        }

        // Fetch reservations for the room and date
        $reservationSql = "SELECT r.time_Start, r.time_End, r.reserve_Title, r.reserve_PIC, r.reserve_Contact, r.reserve_Notes, a.admin_Name, d.department_Name 
                            FROM reservation r
                            JOIN administrator a ON r.admin_ID = a.admin_ID
                            JOIN department d ON r.department_ID = d.department_ID
                            WHERE r.reserve_Date = '$selectedDate' 
                            AND r.room_ID = $mRoom";

        $reservationResult = mysqli_query($connect, $reservationSql);
        $reservedTimeSlots = array();

        // Collect the reserved time slots
        while ($row = mysqli_fetch_assoc($reservationResult)) {
            $start = $row['time_Start'];
            $end = $row['time_End'];

            // Remove subsequent time slots within the same reservation
            for ($i = $start + 1; $i < $end; $i++) {
                unset($timeSlots[$i]);
            }

            // Add the start and end times to the reservedTimeSlots array
            $reservedTimeSlots[$start] = array(
                'start_time' => $row['time_Start'],
                'end_time' => $row['time_End'],
                'reserve_PIC' => $row['reserve_PIC'],
                'department_Name' => $row['department_Name'],
                'reserve_Title' => $row['reserve_Title']
            );
        }
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
        border-radius: 30px 30px 30px 30px;
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
        table-layout: fixed;
        width: 90%;
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

    .register { 
		position: relative;
		margin-top: 2%;
		margin-left: 6%;
		margin-bottom: 10px;
    }

    .center-top {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        margin-top: 15px;
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
        <div class="background"><br><br>

            <h1><center><?php echo $roomName; ?></center></h1>
            <h2><center><?php echo date('d-m-Y', strtotime($selectedDate)); ?></center></h2>

            <?php if (count($timeSlots) > 0) { ?>

                <center>
                    <table id="room" class="myTable">
                        <tr>
                            <th style="border-radius: 20px 0px 0px 0px">SLOT</th>
                            <th>TITLE</th>
                            <th>DETAILS</th>
                            <th>STATUS</th>
                            <th style="border-radius: 0px 20px 0px 0px">ACTION</th>
                        </tr>
                <center>

                        <tbody>
                            <?php foreach ($timeSlots as $timeID => $timePeriod) {
                                // Exclude 01:00 PM and 05:00 PM from being displayed as available time slots
                                if ($timePeriod == '01:00 PM' || $timePeriod == '05:00 PM') {
                                    continue;
                                }

                                $isReserved = isset($reservedTimeSlots[$timeID]);
                                $reservedStart = $isReserved ? $reservedTimeSlots[$timeID]['start_time'] : null;
                                $reservedEnd = $isReserved ? $reservedTimeSlots[$timeID]['end_time'] : null;
                                $picName = $isReserved ? $reservedTimeSlots[$timeID]['reserve_PIC'] : '-';
                                $departmentName = $isReserved ? $reservedTimeSlots[$timeID]['department_Name'] : '-';
                                $reserveTitle = $isReserved ? $reservedTimeSlots[$timeID]['reserve_Title'] : '-';
                            ?>
                                <tr style='color:black; font-family: Arial, Helvetica, sans-serif;'>
                                    <td style='font-weight:bold;'>
                                        <?php
                                        if ($isReserved) {
                                            $startTime = $timeSlots[$timeID];
                                            $endTime = $timeSlots[$reservedEnd];
                                            echo $startTime . ' - ' . $endTime;
                                        } else {

                                           
                                            // Convert the time to a DateTime object
                                            $timeObj = DateTime::createFromFormat('h:i A', $timePeriod);

                                            // Add 1 hour
                                            $timeObj->modify('+1 hour');

                                            // Format the result back to the original format
                                            $newTimePeriod = $timeObj->format('h:i A');

                                            echo $timePeriod . " - " . $newTimePeriod;
                                            // Before edit
                                            // echo $timePeriod;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($isReserved) { ?>
                                            <?php echo $reserveTitle; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($isReserved) { ?>
                                            <a><b>Person In-Charge: </b><br><?php echo $picName; ?></a><br><br>
                                            <a><b>Department: </b><br><?php echo $departmentName; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td style="font-weight:bold; color: <?php echo $isReserved ? '#D21404' : 'green'; ?>;">
                                        <?php echo $isReserved ? 'Not Available' : 'Available'; ?>
                                    </td>
                                    <td>
                                        <?php if (!$isReserved) { ?>
                            
                                            <div class="center-top">
                                                <form name="register" method="POST" action="../Main/reservationRegister.php?room_id=<?php echo $mRoom; ?>&time_id=<?php echo $timeID; ?>&date=<?php echo $selectedDate;  ?>">
                                                    <input type="hidden" name="room_id" value="<?php echo $mRoom; ?>">
                                                    <input type="hidden" name="date" value="<?php echo $selectedDate; ?>">
                                                    <input type="hidden" name="time_id" value="<?php echo $timeID; ?>">
                                                    <input type="hidden" name="room_name" value="<?php echo urlencode($roomName); ?>">
                                                    <button type="submit" class="reservation-button">Make Reservation</button>
                                                </form>
                                            </div>

                                        <?php } else { ?>
                                            <div class="center-top2">
                                                <form name="register" onsubmit="return false;" style="cursor: not-allowed;">
                                                    <button type="submit" class="reservation-button" style="cursor: not-allowed;" disabled>Make Reservation</button>
                                                </form>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            <?php } else { ?>
                <p>No time slots found.</p>
            <?php } ?>
        </div>
    </body>
        <div class="button-container">
            <button class="back-button" id="backButton">Back</button>
        </div>
</html>

<script>
    document.getElementById("backButton").onclick = function() {
        window.history.back();
    };
</script>
