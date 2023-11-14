<?php
    include "../connect.php";
    include "../iconTab.php";
    include "topNavigation.php";
    session_start();
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
        width: 95%;
        background: white;
        border-radius: 20px 20px 20px 20px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: black;
        text-align: center;
        opacity: 97%;
    }

    .myTable th {
        font-family: Verdana, sans-serif;
        text-shadow: 1px 1px 4px black;
        font-size: 12px;
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
        font-size: 12px;
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

    .custom-button {
        font-size: 15px;
        width: 100px;
        height: 30px;
        margin: 5px;
    }
</style>

<!DOCTYPE html>
<html>
    <body>
        <nav class="topnav" id="myTopnav">
            <img src="../Images/logo.png">
            <a href="../logoutFunction.php">
                <i class="fa fa-sign-out"></i>
            </a>
            <a href="searchPage.php">
                <i class="fa fa-home"></i>
            </a>
        </nav>
        <div class="background"><br>

            <h1><center>HISTORY</center></h1>

            <center>
                <input class="custom-button" type="button" value="Back" onclick="goBack()"><br><br><br>
            </center>

            <center>
                <table class="myTable">
                    <tr>
                        <th style="border-radius: 20px 0px 0px 0px">START DATE</th>
                        <th>END DATE</th>
                        <th>STATUS</th>
                        <th>POSITION</th>
                        <th>GRADE</th>
                        <th>DEPARTMENT</th>
                        <th>WARD/CLINIC</th>
                        <th style="border-radius: 0px 20px 0px 0px">MODIFY</th>
                        <!-- Add more table headers for other columns as needed -->
                    </tr>

                    <?php
                    // Check if a staff ID is provided in the URL
                    if (isset($_GET['staff_ID'])) {
                        $staff_ID = $_GET['staff_ID'];

                        // Perform a database query to retrieve distinct enc_IDs for the staff_ID
                        $encounterSql = "SELECT DISTINCT enc_ID, enc_Start, enc_End, enc_Action FROM encounter WHERE enc_Staff = '$staff_ID' ORDER BY enc_Start ASC";
                        $encounterResult = mysqli_query($connect, $encounterSql);

                        // Check if any encounter results were found
                        if (mysqli_num_rows($encounterResult) > 0) {
                            while ($row = mysqli_fetch_assoc($encounterResult)) {
                                $enc_ID = $row['enc_ID'];
                                $enc_Start = date('d-m-Y', strtotime($row['enc_Start']));
                                $enc_End = date('d-m-Y', strtotime($row['enc_End']));
                                $enc_Action = $row['enc_Action'];

                                // Perform another query to retrieve encounter information for the enc_ID
                                $encounterDetailsSql = "SELECT encounter.*, department.dept_Name, status.stat_Type, modify.mod_Type
                                                        FROM encounter
                                                        LEFT JOIN department ON encounter.enc_Department = department.dept_ID
                                                        LEFT JOIN status ON encounter.enc_Status = status.stat_ID
                                                        LEFT JOIN modify ON encounter.enc_Modify = modify.mod_ID
                                                        WHERE encounter.enc_ID = '$enc_ID'";

                                $encounterDetailsResult = mysqli_query($connect, $encounterDetailsSql);

                                // Check if any encounter details were found
                                if (mysqli_num_rows($encounterDetailsResult) > 0) {

                                    while ($detailsRow = mysqli_fetch_assoc($encounterDetailsResult)) {
                                        echo '<tr>';
                                        echo '<td>' . $enc_Start . '</td>';
                                        echo '<td>' . $enc_End . '</td>';
                                        echo '<td>' . $detailsRow['stat_Type'] . '</td>';
                                        echo '<td>' . $detailsRow['enc_Position'] . '</td>';
                                        echo '<td>' . $detailsRow['enc_Grade'] . '</td>';
                                        echo '<td>' . $detailsRow['dept_Name'] . '</td>';
                                        echo '<td>' . $detailsRow['enc_WardClinic'] . '</td>';
                                        echo '<td>' . $detailsRow['mod_Type'] . '</td>';
                                        // Add more table cells for other columns as needed
                                        echo '</tr>';
                                    }
                                } else {
                                    // Handle the case where no encounter information was found for this enc_ID
                                    echo "Encounter information not found for enc_ID: $enc_ID";
                                }
                            }
                        } else {
                            // Handle the case where no encounter IDs were found for this staff_ID
                            echo "No encounter IDs found for staff_ID: $staff_ID";
                        }
                    } else {
                        // Handle the case where no staff ID is provided in the URL
                        echo "Staff ID not provided.";
                    }
                    ?>
                </table>
            </center>
        </div>
    </body>

</html>

<script>
    function goBack() {
        window.history.back();
    }
</script>
