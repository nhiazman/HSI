<?php 
	session_start(); 
	include "../iconTab.php";
	include "../sideNav.php";
	include "../connect.php";
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
		border-radius:30px 30px 0 0;
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
		table-layout:fixed ;
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

	.register { 
		position: relative;
		margin-top: 2%;
		margin-left: 6%;
		margin-bottom: 10px;
	}

	.search { 
		position: relative;
		text-align: left;
		margin-left: 6%;
		margin-bottom: 10px;
	}

	.custom-button {
		font-size: 13px;
		width: 80px; /* Adjust the width as needed */
		height: 30px; /* Adjust the height as needed */
		margin-top: 5px; /* Adjust the margin as needed */
		margin-bottom: 5px; /* Adjust the margin as needed */
  	}

	.delete-button {
		font-size: 13px;
		width: 80px; /* Adjust the width as needed */
		height: 30px; /* Adjust the height as needed */
		margin-top: 5px; /* Adjust the margin as needed */
		margin-bottom: 5px; /* Adjust the margin as needed */
		background-color: #dc3545; /* Red background color */
		color: white;
		border: none;
		border-radius: 3px; /* Add rounded corners */
		cursor: pointer;
    }

    /* Style for the Delete button when hovered */
	.delete-button:hover {
    	background-color: #b52d3a; /* Darker red background color */
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
		
			<h1><center>ROOM</center></h1>
			
			<div class="register">
				<input type='button' onclick='location.href="roomRegister.php"' value='New Room'>
			</div>
		
			<center>
				<table id="room" class="myTable">
				
					<tr>
						<th style="border-radius: 20px 0px 0px 0px">NAME</th>
						<th>LOCATION</th>
						<th>STATUS</th>
						<th style="border-radius: 0px 20px 0px 0px">ACTION</th>
					</tr>
			<center>
				
			<?php
				$sql = "SELECT * FROM room
						LEFT JOIN status
						ON room.status_ID = status.status_ID";

				$result = mysqli_query($connect, $sql);

				if (mysqli_num_rows($result) > 0) {
					foreach ($result as $row) {
						$rID = $row['room_ID'];
						$rName = $row['room_Name'];
						$rLoc = $row['room_Location'];
						$rStat = $row['status_Type'];

						echo "<tr style='color:black; font-family:Arial;'>";
						echo "<td>$rName</td>";
						echo "<td>$rLoc</td>";

						// Set the color based on the room status
						if ($rStat == 'Available') {
							echo "<td style='color: green;'>$rStat</td>";
						} elseif ($rStat == 'Unavailable') {
							echo "<td style='color: red;'>$rStat</td>";
						} else {
							echo "<td style='color: #FCA510;'>$rStat</td>";
						}

						echo "<td><input class='custom-button' type='button' onclick='location.href=\"roomedit.php?id=$rID\"' value='Edit'> ";
						echo "<input class='delete-button' type='button' onclick='delFunction(\"$rID\")' value='Delete'></td>";
						echo "</tr>";
					}
				}
				mysqli_close($connect);
			?>

			</center>
				</table>
			</center>

		</div>   
		<div class="button-container">
            <input class="back-button" name="cancel" type="button" value="Back" onclick ='location.href="managePage.php"'>
        </div>
	</body>
</html>

<script>
	function delFunction(rID) {
        var r = confirm("Are you sure you want to remove this room?");
        if(r == true) { 
            location.href="roomDelete.php?id=" + rID;
        }
    }
</script>