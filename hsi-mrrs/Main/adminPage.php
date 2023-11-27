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
		text-align:left;
		margin-left: 6%;
		margin-bottom: 10px;
	}

	.reset-button {
        font-size: 13px;
        width: 110px; /* Adjust the width as needed */
        height: 30px; /* Adjust the height as needed */
        margin-top: 5px; /* Adjust the margin as needed */
        margin-bottom: 5px; /* Adjust the margin as needed */
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
		
			<h1><center>ADMINISTRATOR</center></h1>
			
			<div class="register">
				<input type='button' onclick='location.href="adminRegister.php"' value='New Staff'>
			</div>
		
			<div class="search">
				<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search here.." title="Type in a name">
			</div> 
		
			<center>
				<table id="staff" class="myTable">
				
					<tr>
						<th style="border-radius: 20px 0px 0px 0px">ID</th>
						<th>NAME</th>
						<th>USERNAME</th>
						<th>CONTACT</th>
						<th>EXTENSION</th>
						<th style="border-radius: 0px 20px 0px 0px">ACTION</th>
					</tr>
			<center>
					
				<?php
					$sql = "select * from administrator";
					
					$result = mysqli_query($connect,$sql);
					
					if(mysqli_num_rows($result) > 0) 
					{
						foreach($result as $row) { 
							$sID = $row['admin_ID'];
							$aName = $row['admin_Name'];
							$aContact = $row['admin_Contact'];
							$aUsername = $row['admin_Username'];
							$aExt = $row['admin_Ext'];
							
							echo"<tr style='color:black; font-family:Arial;'>";
							echo"<td style='font-weight:bold;'>$sID</td>";
							echo"<td>$aName</td>";
							echo"<td>$aUsername</td>";
							echo"<td>$aContact</td>";
							echo"<td>$aExt</td>";
							
							echo"<td><input class='custom-button' type='button' onclick='location.href=\"adminEdit.php?id=$sID\"' value='Edit'> ";
							echo"<input class='reset-button' type='button' onclick='resetFunction(\"$sID\")' value='Reset Password'> ";
							if($sID != $_SESSION['sID']) {
								echo"<input class='delete-button' type='button' onclick='delFunction(\"$sID\")' value='Delete'></td>";
							}
							echo"</tr>";
						}
					}
					mysqli_close($connect);
				?>

			</center>
				</table>
			</center>

		</div>
		<!-- Button Container -->    
		<div class="button-container">
            <!-- Back Button -->
            <input class="back-button" name="cancel" type="button" value="Back" onclick ='location.href="managePage.php"'>
        </div>
	</body>
</html>

<script>
	function delFunction(sID) {
        var r = confirm("Are you sure you want to remove this user?");
        if(r == true) { 
            location.href="adminDelete.php?id=" + sID;
        }
    }
	
	function resetFunction(sID) {
        var r = confirm("Are you sure you want to reset the user's password?");
        if(r == true) { 
            location.href="adminReset.php?id=" + sID;
        }
    }

	function myFunction() {
		var input, filter, table, tr, td1, td2, td3, td4, td5, i, txtValue1, txtValue2, txtValue3, txtValue4, txtValue5;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("staff");
		tr = table.getElementsByTagName("tr");

		for (i = 0; i < tr.length; i++) {
			td1 = tr[i].getElementsByTagName("td")[0]; // Staff ID column
			td2 = tr[i].getElementsByTagName("td")[1]; // Staff name column
			td3 = tr[i].getElementsByTagName("td")[2]; // Staff contact number column
			td4 = tr[i].getElementsByTagName("td")[3]; // Staff department column
			td5 = tr[i].getElementsByTagName("td")[4]; // Staff status column

			if (td1 && td2 && td3 && td4 && td5) {
				txtValue1 = td1.textContent || td1.innerText;
				txtValue2 = td2.textContent || td2.innerText;
				txtValue3 = td3.textContent || td3.innerText;
				txtValue4 = td4.textContent || td4.innerText;
				txtValue5 = td5.textContent || td5.innerText;

				if (
					txtValue1.toUpperCase().indexOf(filter) > -1 ||
					txtValue2.toUpperCase().indexOf(filter) > -1 ||
					txtValue3.toUpperCase().indexOf(filter) > -1 ||
					txtValue4.toUpperCase().indexOf(filter) > -1 ||
					txtValue5.toUpperCase().indexOf(filter) > -1
				) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}

</script>