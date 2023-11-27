<?php 
    session_start(); 
    include "../iconTab.php";
    include "../sideNav.php";
    include "../connect.php";
?>

<style>
    .background h1 {
        color: #fff; 
        font-family: 'Barlow'; 
        font-size: 60px; 
        text-shadow: 1px 1px 4px black;
        text-transform: uppercase;
    }

    /* Hide Scrollbar */
    ::-webkit-scrollbar {
        display: none;
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
        padding: 20px;
        margin: 50px;
    }

    .container center {
        color: red;
    }

    .left-col {
        float: left;
        width: 25%;
        margin-top: 6px;
    }

    .right-col {
        float: left;
        width: 75%;
        margin-top: 14px;
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

    .register-button {
        font-size: 16px;
        padding: 10px 20px;
        background-color: #007bff; /* Blue background color */
        color: white;
        border: none;
        border-radius: 4px; /* Rounded corners */
        cursor: pointer;
    }

    /* Style the back button */
    .back-button {
        font-size: 16px;
        background-color: #ddd; /* Gray */
        color: black;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
    }
            
    /* Add hover effect */
    .back-button:hover {
        background-color: #A9A9A9; /* Darker gray on hover */
        color: black;
    }
</style>

<!DOCTYPE html>
<html>
    <body>
        <div class="background"><br><br>
        
            <h1><center>REGISTER TIME</center></h1>

            <div class="container">
                
                <center>
                <?php
                    if(isset($_SESSION["status"])){
                        echo $_SESSION["status"];
                    }
                ?> 
                </center>

                <br>

                <form action="timeAdd.php" method="post">
                
                    <div class="row">
                        <div class="left-col">
                            <label for="tPeriod" style= "font-family: Arial; font-size: 14px;">Time:</label>
                        </div>
                        <div class="right-col">
                            <input type="time" step="60" id="tPeriod" name="tPeriod" placeholder="Enter Time Period.." required>
                        </div>
                    </div>

                    <br><br>

                    <div class="row">
                        <center>
                        <input class="back-button" name="cancel" type="button" value="Back" onclick ='location.href="timePage.php"'>
                        <button class="register-button">Register</button><br>
                        </center>
                    </div>
                
                </form>
            </div>
        </div>
    </body>
</html>

<?php 
    if(isset($_SESSION["status"])){
        unset ($_SESSION["status"]);
    }
?>