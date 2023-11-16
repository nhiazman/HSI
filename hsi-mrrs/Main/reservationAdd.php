<?php
	include "../connect.php";
	include "../logActivity.php";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$sID = $_SESSION['userID'];
		$roomID = $_POST['mRoom'];
		$rTitle = $_POST['mTitle'];
		$rDate = $_POST['mDate'];
		$sTime = $_POST['sTime'];
		$eTime = $_POST['eTime'];
		$equip = $_POST['recEq'];

		if ($eTime <= $sTime) {
			$_SESSION['status'] = "Please adjust the Meeting Start Time and End Time";
			header("location: reservationRegister.php?room_id=$roomID&time_id=$sTime&date=$rDate");
		} else {
			$sql = "SELECT * FROM reservation
                    INNER JOIN time on reservation.time_start = time.time_ID
                    WHERE room_ID = '$roomID' AND reserve_Date = '$rDate' 
                    AND (time_Start < '$eTime' AND time_End > '$sTime')";

			$result = mysqli_query($connect, $sql);

			if (mysqli_num_rows($result) > 0) {
				// The room is already reserved during the selected time slot
				$_SESSION['status'] = "The room is not available at that time.";
				header("location: reservationRegister.php?room_id=$roomID&time_id=$sTime&date=$rDate");
			} else {
				// Insert the reservation into the database
				$register = "INSERT INTO `reservation`(`staff_ID`, `room_ID`, `reserve_Title`, `reserve_Date`, `time_Start`, `time_End`, `equipment`) 
							VALUES ('$sID', '$roomID', '$rTitle', '$rDate', '$sTime', '$eTime', '$equip')";
				$exec = mysqli_query($connect, $register);

				if ($exec) {
					// Reservation created successfully, log the activity
					$reservationId = mysqli_insert_id($connect); // Get the ID of the inserted reservation

					// Fetch the time periods for start time and end time from the time table
					$startTimeQuery = "SELECT time_Period FROM time WHERE time_ID = '$sTime'";
					$endTimeQuery = "SELECT time_Period FROM time WHERE time_ID = '$eTime'";
					$startTimeResult = mysqli_query($connect, $startTimeQuery);
					$endTimeResult = mysqli_query($connect, $endTimeQuery);
					$startTimeData = mysqli_fetch_assoc($startTimeResult);
					$endTimeData = mysqli_fetch_assoc($endTimeResult);

					// Format the activity message with the formatted date and time periods
					$formattedDate = date("d-m-Y", strtotime($rDate));
					$startTimeFormatted = date("h:i A", strtotime($startTimeData['time_Period']));
					$endTimeFormatted = date("h:i A", strtotime($endTimeData['time_Period']));

					$activity = "Create new reservation. (ID: $reservationId)";
					// $activity = "Created reservation: " . $formattedDate . " (" . $startTimeFormatted . " - " . $endTimeFormatted . ")";
					logActivity($sID, $reservationId, $activity);

					echo '<script>alert("Your reservation has been submitted!");</script>';
                	echo '<script>window.location.href = "reservationPage.php";</script>';
				} else {
					$_SESSION['status'] = "An error has occurred!";
					header("location: reservationRegister.php?room_id=$roomID&time_id=$sTime&date=$rDate");
				}
			}
		}
	}
?>
