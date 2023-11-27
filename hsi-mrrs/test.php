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
    width: 86%;
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

      <div class="search">
				<input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search here...">
			</div> 

      <center>
      <table id="log" class="myTable">
					
					<tr>
						<th style="border-radius: 20px 0px 0px 0px">TIMESTAMP</th>
						<th>ADMINISTRATOR</th>
						<th style="border-radius: 0px 20px 0px 0px">LOG ACTIVITY</th>
					</tr>
				
					<?php
            // Define the number of records to show per page
            $recordsPerPage = 14;

            // Get the current page number from the query parameter or set it to 1 if not provided
            if (isset($_GET['page'])) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }

            // Calculate the offset to retrieve the correct records for the current page
            $offset = ($currentPage - 1) * $recordsPerPage;

						$sql = "SELECT 
								log_ID,
								DATE_FORMAT(log_Time, '%d-%m-%Y %h:%i %p') 
                AS formatted_log_Time,  
								log_Action,
								log.admin_ID,
								log.reserve_ID
								FROM log
								LEFT JOIN administrator
								ON log.admin_ID = administrator.admin_ID
								LEFT JOIN reservation
								ON log.reserve_ID = reservation.reserve_ID
								ORDER BY log_Time DESC LIMIT $offset, $recordsPerPage";
						
						$result = mysqli_query($connect,$sql);
						
						if(mysqli_num_rows($result) > 0) 
						{
							foreach($result as $row) { 
								$lID = $row['log_ID'];
								$lTime = $row['formatted_log_Time'];
								$lActivity = $row['log_Action'];
								$sID = $row['admin_ID'];
								$rID = $row['reserve_ID'];
									
								echo"<tr>";
								echo"<td>$lTime</td>";
								echo "<td>" . sprintf("%06s", $sID) . "</td>"; // Format sID as a 6-character string with leading zeros
								echo"<td>$lActivity</td>";
								echo"</tr>";
							}
						}
					?>
				</table>
        <br>
        <div class="pagination">
          <?php
            // Calculate the total number of pages
            $sql = "SELECT COUNT(*) AS total_records FROM log";
            $result = mysqli_query($connect, $sql);
            $totalRecords = mysqli_fetch_assoc($result)['total_records'];
            $totalPages = ceil($totalRecords / $recordsPerPage);

            // Display "Previous" link if not on the first page
            if ($currentPage > 1) {
              echo "<a href='dashboardPage.php?page=" . ($currentPage - 1) . "'>Previous</a>";
            }

            // Display first page
            $style = ($currentPage == 1) ? "class='current-page'" : "";
            echo "<a href='dashboardPage.php?page=1' $style>1</a>";
 
            if ($currentPage > 4) {
              // Add an ellipsis if there are more pages before the current page
              echo "<span class='ellipsis'>...</span>";
            }

            // Display page numbers
            for ($i = max(2, $currentPage - 2); $i <= min($totalPages - 1, $currentPage + 2); $i++) {
              $style = ($i == $currentPage) ? "class='current-page'" : "";
              echo "<a href='dashboardPage.php?page=$i' $style>$i</a>";
            }

            if ($currentPage < $totalPages - 3) {
              // Add an ellipsis if there are more pages after the current page
              echo "<span class='ellipsis'>...</span>";
            }

            // Display last page
            $style = ($currentPage == $totalPages) ? "class='current-page'" : "";
            echo "<a href='dashboardPage.php?page=$totalPages' $style>$totalPages</a>";

            // Display "Next" link if not on the last page
            if ($currentPage < $totalPages) {
              echo "<a href='dashboardPage.php?page=" . ($currentPage + 1) . "'>Next</a>";
            }

            mysqli_close($connect);
          ?>
        </div>
      </center>
		</div> 
  </body>
</html>

<script>
	function filterTable() {
		// Declare variables
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("searchInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("log");
		tr = table.getElementsByTagName("tr");

		// Loop through all table rows, and hide those that don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td");
			for (var j = 0;
			j < td.length; j++) {
				if (td[j]) {
					txtValue = td[j].textContent || td[j].innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
						break;
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	}
</script>