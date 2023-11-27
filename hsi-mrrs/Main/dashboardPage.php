<?php
  session_start();
  include('../iconTab.php');
  include('../sideNav.php');
  include('../connect.php');

  $currDate = date('Y-m-d');
                                
  //$tmrDate = new DateTime('tomorrow');
  $tmrDate = date("Y-m-d", strtotime("+1 day"));
                                
  //code for today 
  $sql ="SELECT COUNT(*) AS row_count FROM reservation where reserve_Date = '$currDate'";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
                               
  // Get the row count value
  $rowCount = $row['row_count'];
                                               
  //code for tomorrow 
  $Tsql ="SELECT COUNT(*) AS Trow_count FROM reservation where reserve_Date = '$tmrDate'";
  $Tresult = mysqli_query($connect, $Tsql);
  $Trow = mysqli_fetch_assoc($Tresult);
                                
  // Get the row count value
  $TrowCount = $Trow['Trow_count'];
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
    text-shadow: 10px 10px 5px black;
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
    margin-left: 200px;
  }

  .table-container {
    width: 90%;
    max-height: 300px;
    overflow: auto;
  }

  .myTable {
    table-layout: fixed;
    width: 90%;
    background: white;
    border-radius: 20px 20px 0px 0px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    color: black;
    text-align: center;
    opacity: 97%;
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
    position: sticky;
    top: 0;
  }

  .myTable td,
  .myTable th {
    padding: 5px;
    border: 1px solid #000;
    overflow-wrap: break-word;
    word-wrap: break-word;
    text-align: center;
  }

  .register {
    position: relative;
    margin-top: 2%;
    margin-left: 6%;
    margin-bottom: 10px;
    font-size: 13px;
  }

  .search {
    position: relative;
    text-align: left;
    margin-left: 8%;
    margin-bottom: 10px;
    font-size: 13px;
  }

  /* Added CSS for search input */
	#searchInput {
		width: 200px;
		padding: 5px;
		border-radius: 5px;
		border: none;
		box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
	}

  .card-icon {
    margin-left: 300px;
    margin-bottom: 15px;
    display: inline-block;
    width: 340px;
    height: 50px;
    background-color: #D21404;
    text-align: center;
    line-height: 50px;
    margin: 5px;
    border-radius: 10px;
    font-family: "Helvetica";
    font-size: 13px;
    font-weight: bold;
    border: 3px solid #fff;
    opacity: 95%;
  }

  .card-icon a {
    color: white;
    text-shadow: 1px 1px 4px black;
  }

  .left-col {
    float: left;
    width: 5%;
    margin-left: 40px;
    text-align: left;
    color: white;
    text-shadow: 1px 1px 4px black;
    font-weight: bold;
    font-size: 20px;
  }

  .right-col {
    float: left;
    width: 70%;
    text-align: left;
    margin-left: 15px;
    font-size: 14px;
    color: black;
  }

  .pagination {
    margin: 10px 0;
    text-align: center;
  }

  .pagination a, .pagination .current-page {
    display: inline-block;
    padding: 8px 12px;
    margin: 2px;
    border-radius: 5px;
    text-decoration: none;
    color: black; /* Change text color to black */
    background-color: white;
    transition: background-color 0.3s, color 0.3s;
  }

  .pagination a:hover {
    background-color: #bf0000; /* Change the background color on hover to gray */
    color: white; /* Change text color to white on hover */
  }

  .pagination .current-page {
    background-color: #bf0000; /* Change the background color for the current page to gray */
    color: white; /* Change text color for the current page to white */
  }

  .pagination .ellipsis {
    margin: 0 10px;
  }

  .register { 
		position: relative;
		margin-top: 2%;
		margin-left: 6%;
		margin-bottom: 10px;
	}

	.search { 
		position: relative;
		text-align:left;
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
</style>


<!DOCTYPE html>
<html>
  <body>
		<div class="background"><br><br>

      <h1><center>DASHBOARD</center></h1>
      
      <center>

        <div class="card-icon">
          <div class="left-col">
            <?php echo $rowCount; ?>
          </div>
          <div class="right-col">
            <a>RESERVATION FOR TODAY</a>
          </div>
        </div>

        <div class="card-icon">
          <div class="left-col">
            <?php echo $TrowCount; ?>
          </div>
          <div class="right-col">
            <a>RESERVATION FOR TOMORROW</a>
          </div>
        </div>

      </center>

      <br>

      <div class="register">
				<input type='button' onclick='location.href="../Main/reservationRegister.php"' value='New Reservation'>
			</div>

			<div class="search">
				<label style="color: #fff; font-weight:bold;">Filter Date: </label>
				<input type="date" id="myInput" onchange="myFunction()" placeholder="Search for Date.." title="Type in a name">
			</div>
		
			<center>
				<table id="reservation" class="myTable">
					<tr>
						<th style="border-radius: 20px 0px 0px 0px">DATE & TIME</th>
						<th>ROOM</th>
						<th>TITLE</th>
						<th>DETAILS</th>
						<th style="border-radius: 0px 20px 0px 0px">ACTION</th>
					</tr>
			<center>
				
				<?php
					$sID = $_SESSION["sID"];		
					$currDate = date('Y-m-d');
					$tmrDate = date("Y-m-d", strtotime("+1 day"));

					// Define the number of items per page
					$itemsPerPage = 6;

					// Get the current page from the URL, or default to page 1
					$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

					// Calculate the offset (starting row) for the SQL query
					$offset = ($currentPage - 1) * $itemsPerPage;
				  
					$sql = "SELECT 
						reserve_ID, 
                        reserve_Title, 
						reserve_Date,
                        reserve_PIC,
                        reserve_Contact,
                        reserve_Notes,
						reservation.admin_ID, 
						reservation.room_ID, 
                        reservation.department_ID,
						room.room_Name,
                        department.department_Name,
						(SELECT time_period FROM time WHERE time_start = time_id) AS startTime, 
						(SELECT time_period FROM time WHERE time_end = time_id) AS endTime 
						FROM reservation 
						LEFT JOIN administrator 
						ON reservation.admin_ID = administrator.admin_ID 
                        LEFT JOIN room 
						ON reservation.room_ID = room.room_ID 
                        LEFT JOIN department 
						ON reservation.department_ID = department.department_ID 
						LEFT JOIN time 
						ON time.time_ID = reservation.time_Start
						ORDER BY reserve_Date DESC, time_Start ASC LIMIT $itemsPerPage OFFSET $offset";
					
					$result = mysqli_query($connect,$sql);
				
					if(mysqli_num_rows($result) > 0) 
					{
						foreach($result as $row) { 
							$rID = $row['reserve_ID'];
							$rRoom = $row['room_Name'];
							$rTitle = $row['reserve_Title'];
                            $rPIC = $row['reserve_PIC'];
                            $rDept = $row['department_Name'];
							$rDate = $row['reserve_Date'];
							$rStart = $row['startTime'];
							$rEnd = $row['endTime'];
							$Date = date('d/m/Y', strtotime($rDate));
							$startTime = date('h:i a', strtotime($rStart));
							$endTime = date('h:i a', strtotime($rEnd));
						
							echo"<tr style='color:black; font-family:Arial;'>";
							echo"<td style='display: none;'>$rDate</td>";
							echo"<td style='font-weight:bold; text-transform:uppercase;'>$Date<br><br>$startTime - $endTime</td>";
							echo"<td>$rRoom</td>";
							echo"<td>$rTitle</td>";
                            echo"<td>$rPIC<br><br>$rDept</td>";
							echo"<td><input class='custom-button' style='font-size: 13px;' type='button' onclick='location.href=\"reservationEdit.php?id=$rID\"' value='Edit'><br>";
							echo"<input class='delete-button' style='font-size: 13px;' type='button' onclick='delFunction(\"$rID\")' value='Delete'></td>";
							echo"</tr>";
						}
					}
				?>
			
			</center>
				</table>
				<div class="pagination">
					<?php
						// Calculate the total number of pages
						$countSql = "SELECT COUNT(*) AS totalRows FROM reservation WHERE admin_ID = '$sID'";
						$countResult = mysqli_query($connect, $countSql);
						$countRow = mysqli_fetch_assoc($countResult);
						$totalRows = $countRow['totalRows'];
						$totalPages = ceil($totalRows / $itemsPerPage);

						// Display "Previous" link if not on the first page
						if ($currentPage > 1) {
							echo "<a href='reservationPage.php?page=" . ($currentPage - 1) . "'>Previous</a>";
						}

						// Display first page
						$style = ($currentPage == 1) ? "class='current-page'" : "";
						echo "<a href='reservationPage.php?page=1' $style>1</a>";

						if ($currentPage > 4) {
							// Add an ellipsis if there are more pages before the current page
							echo "<span class='ellipsis'>...</span>";
						}

						// Display page numbers
						for ($i = max(2, $currentPage - 2); $i <= min($totalPages - 1, $currentPage + 2); $i++) {
							$style = ($i == $currentPage) ? "class='current-page'" : "";
							echo "<a href='reservationPage.php?page=$i' $style>$i</a>";
						}

						if ($currentPage < $totalPages - 3) {
							// Add an ellipsis if there are more pages after the current page
							echo "<span class='ellipsis'>...</span>";
						}

						// Display last page
						$style = ($currentPage == $totalPages) ? "class='current-page'" : "";
						echo "<a href='reservationPage.php?page=$totalPages' $style>$totalPages</a>";

						// Display "Next" link if not on the last page
						if ($currentPage < $totalPages) {
							echo "<a href='reservationPage.php?page=" . ($currentPage + 1) . "'>Next</a>";
						}

						mysqli_close($connect);
					?>
				</div>
			</center>

		</div>
	</body>
</html>

<script>
	function delFunction(rID) {
		var r = confirm("Are you sure you want to delete this reservation?");
		if (r == true) {
			location.href = "reservationDelete.php?id=" + rID;
		}
	}

	function myFunction() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("reservation");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} 
				else {
					tr[i].style.display = "none";
				}
			}       
		}
	}
</script>