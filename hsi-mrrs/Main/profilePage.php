<?php 
	session_start(); 
	include "../iconTab.php";
	include "../sideNav.php";
	include "../connect.php";
	
	$sID = $_SESSION["sID"];
	$sql = "SELECT * FROM administrator
			WHERE admin_ID = '$sID'";
			
	$result = $connect->query($sql);
						
	foreach($result as $row) {
		$aName = $row['admin_Name'];
        $aUsername = $row['admin_Username'];
        $aPassword = $row['admin_Password'];
		$aContact = $row['admin_Contact'];
		$aExt = $row['admin_Ext'];
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

	input[type=password], select, textarea {
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
		width: 700px; /* Set the desired width */
  		max-width: 100%; /* Ensure the container doesn't exceed the viewport width */
  		margin: 0 auto;
		padding: 20px;
	}

	.container h2{
		font-family: 'Helvetica';
		text-transform: uppercase;
		color: #464646;
		text-shadow: 1px 1px 1px black;
	}

	.left-col {
		float: left;
		width: 10%;
		margin-top: 6px;
		margin-left: 40px;
	}

	.right-col {
		float: right;
		width: 50%;
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

	.custom-button {
		font-size: 13px;
		width: 120px; /* Adjust the width as needed */
		height: 30px; /* Adjust the height as needed */
  	}
</style>

<!DOCTYPE html>
<html>
	<body>
		<div class="background"><br><br>
		
			<h1><center>PROFILE</center></h1>
			
			<div class="container">
					
				<h2><center><?=$aName;?></center></h2>
				<hr>
				
				<div class="row">
					<div class="left-col">
						<label style= "font-family: Arial; font-size: 14px;">ID:</label>
					</div>
					<div class="right-col">
						<label style= "font-family: Arial; font-size: 14px;"><?=$sID;?></label>
					</div>
				</div>

				<div class="row">
					<div class="left-col">
						<label style= "font-family: Arial; font-size: 14px;">Contact:</label>
					</div>
					<div class="right-col">
						<label style= "font-family: Arial; font-size: 14px;"><?=$aContact;?></label>
					</div>
				</div>
				
                <div class="row">
					<div class="left-col">
						<label style= "font-family: Arial; font-size: 14px;">Username:</label>
					</div>
					<div class="right-col">
						<label style= "font-family: Arial; font-size: 14px;"><?=$aUsername;?></label>
					</div>
				</div>

                <div class="row">
					<div class="left-col">
						<label style= "font-family: Arial; font-size: 14px;">Password:</label>
					</div>
					<div class="right-col">
						<label style= "font-family: Arial; font-size: 14px;"><?=$aPassword;?></label>
					</div>
				</div>

				<div class="row">
					<div class="left-col">
						<label style= "font-family: Arial; font-size: 14px;">Extension:</label>
					</div>
					<div class="right-col">
						<label style= "font-family: Arial; font-size: 14px;"><?=$aExt;?></label>
					</div>
				</div>

				<br>
					
				<div style="text-align: center; margin: 10px">
					<input class='custom-button' type='button' onclick='location.href="profileUpdate.php"' value='Update Profile'><br>
				</div>
			
			</div>
		</div>
	</body>
</html>