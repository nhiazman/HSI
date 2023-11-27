<?php 
    include "connect.php";
    include "iconTab.php";
    include "topNav.php";
    session_start();

    // Check if a staff ID is provided in the URL
    if (isset($_GET['staff_ID'])) {
        $staff_ID = $_GET['staff_ID'];

        // Perform a database query to retrieve staff information
        $sql = "SELECT staff.*, department.dept_Name, status.stat_Type, modify.mod_Type
                FROM staff
                LEFT JOIN department ON staff.staff_Department = department.dept_ID
                LEFT JOIN status ON staff.staff_Status = status.stat_ID
                LEFT JOIN modify ON staff.staff_Modify = modify.mod_ID
                WHERE staff.staff_ID = '$staff_ID'";
        
        $result = mysqli_query($connect, $sql);

        // Check for SQL errors
        if (!$result) {
            die(mysqli_error($connect));
        }

        // Check if any results were found
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Display the fetched row for debugging
            // var_dump($row);

            // Display the staff information
            $sID = $row['staff_ID'];
            $sName = $row['staff_Name'];
            $sUname = $row['staff_Username'];
            $sPass = $row['staff_Password'];
            $sContact = $row['staff_Contact'];
            $sExt = $row['staff_Extension'];
            $sPosition = $row['staff_Position'];
            $sGrade = $row['staff_Grade'];
            $sDept = $row['dept_Name'];
            $sWC = $row['staff_WardClinic'];
            $sStat = $row['staff_Status'];
            $sDetails = $row['staff_Details'];
            $sMod = $row['staff_Modify'];
            $sStartDate = date('d-m-Y', strtotime($row['staff_Start']));
            $sEndDate = date('d-m-Y', strtotime($row['staff_End']));

            // You can format and display this data as needed in your HTML
        } else {
            // Handle the case where no staff information was found
            echo "Staff information not found.";
        }
    } else {
        // Handle the case where no staff ID is provided in the URL
        echo "Staff ID not provided.";
    }
?>

<style>
    /* Hide Scrollbar */
    ::-webkit-scrollbar {
        display: none;
    }

    .background h1 {
        color: #000;
        font-family: 'Arial';
        font-size: 45px;
        /* text-shadow: 10px 10px 5px black; */
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
        margin: 0; /* Add this line to remove the default margin */
        background-color: white;
        background-size: cover;
        background-position: center;
        height: 760px;
        position: relative;
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
        border-radius: 20px 20px 20px 20px;
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
        background-color: #1A43BF;
        color: white;
        text-align: center;
        position: sticky;
        top: 0;
    }

    .myTable tr {
        font-family: Arial, Helvetica, sans-serif;
        /* text-shadow: 1px 1px 4px black; */
        font-size: 13px;
        height: 30px;
        letter-spacing: 0.05em;
        background-color: white;
        color: black;
        text-align: center;
        position: sticky;
        top: 0;
    }

    .myTable td, .myTable th {
        padding: 0px;
        border: 1px solid #000;
        overflow-wrap: break-word;
        word-wrap: break-word;
        text-align: center;
    }

    .back-button {
		font-size: 13px;
		width: 80px; /* Adjust the width as needed */
		height: 30px; /* Adjust the height as needed */
		margin-top: 5px; /* Adjust the margin as needed */
		margin-bottom: 5px; /* Adjust the margin as needed */
  	}
</style>

<!DOCTYPE html>
<html>
    <body>
        <nav class="topnav" id="myTopnav">
            <img src="Images/logo.png">
            <a href="loginPage.php">
                <i class="fa fa-sign-in"></i>
            </a>
            <a href="index.php">
                <i class="fa fa-search"></i>
            </a>
        </nav>
        <div class="background"><br><br>

            <h1><center>INFORMATION</center></h1>

            <br>

            <center>
                <table class="myTable">
                    <tr>
                        <th style="border-radius: 20px 0px 0px 0px">IC / PASSPORT NUMBER:</th>
                        <td style="border-radius: 0px 20px 0px 0px"><?php echo $sID; ?></td>
                    </tr>
                    <tr>
                        <th>NAME:</th>
                        <td><?php echo $sName; ?></td>
                    </tr>
                    <tr>
                        <th style="text-shadow: none; font-weight: bold; color: #000; background-color: #fff;">USERNAME:</th>
                        <td style="text-shadow: 1px 1px 4px black; font-weight: bold; color: #fff; background-color: #1A43BF;"><?php echo $sUname; ?></td>
                    </tr>
                    <tr>
                        <th style="text-shadow: none; font-weight: bold; color: #000; background-color: #fff;">PASSWORD:</th>
                        <td style="text-shadow: 1px 1px 4px black; font-weight: bold; color: #fff; background-color: #1A43BF;"><?php echo $sPass; ?></td>
                    </tr>
                    <tr>
                        <th>CONTACT:</th>
                        <td><?php echo $sContact; ?></td>
                    </tr>
                    <tr>
                        <th>EXTENSION:</th>
                        <td><?php echo $sExt; ?></td>
                    </tr>
                    <tr>
                        <th>POSITION:</th>
                        <td><?php echo $sPosition; ?></td>
                    </tr>
                    <tr>
                        <th>GRADE:</th>
                        <td><?php echo $sGrade; ?></td>
                    </tr>
                    <tr>
                        <th>DEPARTMENT:</th>
                        <td><?php echo $row['dept_Name']; ?></td>
                    </tr>
                    <tr>
                        <th>WARD / CLINIC:</th>
                        <td><?php echo $sWC; ?></td>
                    </tr>
                    <tr>
                        <th>START DATE:</th>
                        <td><?php echo $sStartDate; ?></td>
                    </tr>
                    <tr>
                        <th style="border-radius: 0px 0px 0px 20px">END DATE:</th>
                        <td style="border-radius: 0px 0px 20px 0px"><?php echo $sEndDate; ?></td>
                    </tr>
                </table>
                <br><br>
                <td><input class="back-button" type="button" value="Back" onclick="goBack()"></td>
            </center>
        </div>
    </body>
</html>

<script>
    function goBack() {
        window.history.back();
    }
</script>