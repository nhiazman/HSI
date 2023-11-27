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

    body {
        background-image: url("../Images/7.jpg");
        background-size: cover;
        background-position: center;
        height: 760px;
        position: relative;
        margin: 0;
    }
            
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-left: 450px; 
        margin-right: 350px;
        height: 80vh; /* Adjust this value based on your desired height */
    }

    .container h1 {
        color: #fff; 
        font-family: 'Barlow'; 
        font-size: 60px; 
        text-shadow: 10px 10px 5px black;
        text-transform: uppercase;
    }

    /* button style */
    .big-button {
        display: inline-block;
        width: 200px;
        height: 50px;
        background-color: #fff;
        color: #000;
        text-align: center;
        line-height: 50px;
        text-decoration: none;
        margin: 10px;
        border-radius: 10px;
        font-family: "Helvetica";
        font-size: 18px;
        font-weight: bold;
    }

    .big-button:hover {
        background-color: #D21404;
        color: #fff;
        text-shadow: 1px 1px 4px black;
    }

    /* buttons alignment */
    .top-button, .top-between-button, .centered-button, .bottom-between-button, .bottom-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }
</style>

<html>
    <body>
        <div class="container">
            
            <h1><center>MANAGE</center></h1>
            
            <div class="top-between-button">
                <a href="contactPage.php" class="big-button">CONTACT</a>
            </div>
            <div class="bottom-between-button">
                <a href="departmentPage.php" class="big-button">DEPARTMENT</a>
            </div>
            <div class="bottom-button">
                <a href="roomPage.php" class="big-button">ROOM</a>
            </div>
            <div class="top-button">
                <a href="adminPage.php" class="big-button">ADMINISTRATOR</a>               
            </div>
            <div class="centered-button">
                <a href="timePage.php" class="big-button">TIME</a>
            </div>
        </div>
    </body>
</html>
