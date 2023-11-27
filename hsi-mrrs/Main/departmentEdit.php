<?php 
    session_start();
    include "../iconTab.php";
    include "../sideNav.php";
    include "../connect.php";

    $dID = $_GET['id'];
        
    $sql = "SELECT * FROM department WHERE department_ID ='$dID'";
        
    $result = mysqli_query($connect, $sql);  
            
    foreach($result as $row) {
        $dID = $row['department_ID'];
        $dName = $row['department_Name'];
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

    input[type=time]{
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

    /* Style the back button */
    .back-button {
        background-color: #ddd; /* Gray */
        color: black;
        border: none;
        font-size: 16px;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
            
    /* Add hover effect */
    .back-button:hover {
        background-color: #A9A9A9; /* Darker gray on hover */
        color: black;
    }

    /* Center the buttons horizontally */
    .button-container {
        display: flex;
        justify-content: center;
    }

    .button-container button {
        margin: 0 10px; /* Add spacing between the buttons */
    }

    .update-button {
        font-size: 16px;
        padding: 10px 20px;
        background-color: #007bff; /* Blue background color */
        color: white;
        border: none;
        border-radius: 4px; /* Rounded corners */
        cursor: pointer;
    }
</style>

<!DOCTYPE html>
<html>
    <body>
        <div class="background"><br><br>
        
            <h1 style="color: #fff; font-family: 'Barlow'; font-size: 60px;"><center>UPDATE DEPARTMENT</center></h1>

            <div class="container">

                <center>
                <?php
                    if(isset($_SESSION["status"])){
                        echo $_SESSION["status"];
                    }
                ?>   
                </center>
                
                <br>

                <form name="register" method="post" action="departmentUpdate.php">
                
                    <div class="row">
                        <div class="left-col">
                        <label for="dID" style= "font-family: Arial; font-size: 14px;">ID:</label>
                        </div>
                        <div class="right-col">
                        <input type="text" style="background-color: #f0f0f0; color: #808080; cursor: not-allowed;" name="dID" placeholder="Enter Department ID" required value="<?= $dID;?>"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="left-col">
                        <label for="dName" style= "font-family: Arial; font-size: 14px;">Department:</label>
                        </div>
                        <div class="right-col">
                        <input type="text" name="dName" placeholder="Enter Department Name.." required value="<?= $dName;?>"/>
                        </div>
                    </div>
                    
                    <br><br>

                    <div class="row">
                        <center>
                        <input class="back-button" name="cancel" type="button" value="Back" onclick ='location.href="departmentPage.php"'>
                        <button class="update-button">Update</button><br>
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