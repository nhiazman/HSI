<?php
	$current_page = basename($_SERVER['PHP_SELF']); // Get the current page's filename
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<style>
			.side-nav {
				height: 100%;
				width: 180px;
				position: fixed;
				z-index: 1;
				top: 0;
				left: 0;
				background-color: #fff;
				overflow-x: hidden;
				padding-top: 20px;
			}

			.side-nav .logo-icon img {
				height: 60px;
				width: 60px;
				margin-left: 63px;
				margin-top: 10px;
				margin-bottom: 10px;
			}

			.side-nav .logo-icon a {
				text-decoration: none;
				font-size: 25px;
				font-family: "Helvetica";
				color: #000;
				margin-left: 40px;
			}

			.side-nav .logo-icon a:hover {
				background-color: transparent;
				color: black;
			}

			.side-nav a {
				padding: 13px 8px 13px 16px;
				text-decoration: none;
				font-size: 15px;
				font-family: "Helvetica";
				color: #000;
				display: block;
				position: relative;
				font-weight: bold;
			}
				
			.side-nav a:hover {
				background-color: #bf0000;
				color: #fff;
				font-weight: bold;
			}

			.log-out {
				bottom:10; 
				position: absolute; 
				margin-bottom: 20px; 
				transform: translate(60%, -20%);
			}

			.logout-icon {
				font-size: 25px;
				color: #bf0000;
				padding-left: 25px;
			}

			.side-nav .log-out a:hover {
				background-color: transparent;
			}

			/* Style the horizontal rule */
			.side-nav hr {
				margin: 0;
			}

			.active-link {
				background-color: #bf0000;
				color: white !important;
				font-weight: bold;
			}
		</style>
	</head>
	<body> 
		<div class="side-nav">
			<div class="logo-icon">
				<img src="../Images/Logo/hsi.png">
				<a href="../Main/homePage.php">MRRS</a>
			</div>
			<br>
			<hr>
			<a href="../Main/homePage.php" <?php echo ($current_page == 'homePage.php') ? 'class="active-link"' : ''; ?>>HOME</a>
			<hr>			 
			<a href="../Main/dashboardPage.php" <?php echo ($current_page == 'dashboardPage.php') ? 'class="active-link"' : ''; ?>>DASHBOARD</a>
			<hr>
			<a href="../Main/managePage.php" <?php echo ($current_page == 'managePage.php') ? 'class="active-link"' : ''; ?>>MANAGE</a>
			<hr>
			<a href="../Main/profilePage.php" <?php echo ($current_page == 'profilePage.php') ? 'class="active-link"' : ''; ?>>PROFILE</a>
			<hr>
			<div class="log-out">
				<a href="../logoutFunction.php"><i class="fas fa-sign-out-alt logout-icon"></i></a>
			</div>
		</div>
	</body> 
</html>