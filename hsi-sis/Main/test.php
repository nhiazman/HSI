

<?php
    include "../connect.php";
    include "../iconTab.php";
    include "topNavigation.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $start_date = date("Y-m-d", strtotime($_POST['start_date']));
        $end_date = date("Y-m-d", strtotime($_POST['end_date']));

        $report_sql = "SELECT administrator.admin_ID, administrator.admin_Name,
                    SUM(CASE WHEN modify.mod_ID = '1' THEN 1 ELSE 0 END) AS transfer_Count,
                    SUM(CASE WHEN modify.mod_ID = '2' THEN 1 ELSE 0 END) AS status_Count,
                    SUM(CASE WHEN modify.mod_ID = '3' THEN 1 ELSE 0 END) AS position_Count,
                    SUM(CASE WHEN modify.mod_ID = '4' THEN 1 ELSE 0 END) AS grade_Count,
                    SUM(CASE WHEN modify.mod_ID = '5' THEN 1 ELSE 0 END) AS other_Count,
                    SUM(CASE WHEN status.stat_ID = '1' THEN 1 ELSE 0 END) AS permanent_Count,
                    SUM(CASE WHEN status.stat_ID = '2' THEN 1 ELSE 0 END) AS visiting_Count,
                    SUM(CASE WHEN status.stat_ID = '3' THEN 1 ELSE 0 END) AS terminate_Count,
                    SUM(CASE WHEN encounter.enc_Action = 'Register' THEN 1 ELSE 0 END) AS register_Count,
                    SUM(CASE WHEN encounter.enc_Action = 'Modify' THEN 1 ELSE 0 END) AS modify_Count
                FROM administrator
                LEFT JOIN staff ON administrator.admin_ID = staff.staff_By
                LEFT JOIN encounter ON administrator.admin_ID = encounter.enc_By
                LEFT JOIN status ON staff.staff_Status = status.stat_ID
                LEFT JOIN modify ON encounter.enc_Modify = modify.mod_ID
                WHERE DATE(staff.staff_Time) BETWEEN '$start_date' AND '$end_date'
                GROUP BY administrator.admin_ID, administrator.admin_Name";

        $report_query_result = mysqli_query($connect, $report_sql);

        if ($report_query_result === false) {
            die("Database query for report failed: " . mysqli_error($connect));
        }

        while ($row = mysqli_fetch_assoc($report_query_result)) {
            $report_results[] = $row;
        }
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

    .background h5 {
        color: #000;
        font-family: 'Arial';
        font-size: 16px;
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
        background-size: cover;
        background-position: center;
        height: 760px;
        position: relative;
        margin: 0;
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
        font-size: 11px;
        height: 30px;
        letter-spacing: 0.05em;
        background-color: #1A43BF;
        color: white;
        text-align: center;
        /* position: sticky; */
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
        /* position: sticky; */
        top: 0;
    }

    .myTable td, .myTable th {
        padding: 0px;
        border: 1px solid #000;
        overflow-wrap: break-word;
        word-wrap: break-word;
        text-align: center;
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
            <a class="active" href="staffReport.php">
                <i class="fa fa-print"></i>
            </a>
            <a href="staffRegister.php">
                <i class="fa fa-user-plus"></i>
            </a>
            <a href="searchPage.php">
                <i class="fa fa-home"></i>
            </a>
        </nav>

        <div class="background"><br><br>

            <center><h1>REPORT</h1></center>

            <br><br><br>

            <center> 
                <form method="post" action="">
                    <label for="start_date">Date: </label> &nbsp;
                    <input type="date" id="start_date" name="start_date"> &nbsp;
                    <label for="end_date"> to </label> &nbsp;
                    <input type="date" id="end_date" name="end_date"> &nbsp;
                    <input type="submit" value="Filter">
                </form>

                <br><br>
                
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $formatted_start_date = date("d-m-Y", strtotime($start_date));
                        $formatted_end_date = date("d-m-Y", strtotime($end_date));

                        echo "<p style='font-weight: bold; font-size: 18px; font-family: Arial;'>$formatted_start_date to $formatted_end_date</p>";
                    }
                ?>
                
                <br>

                <table class="myTable">
                    <tr>
                        <th style="width: 35px; border-radius: 20px 0px 0px 0px">#</th>
                        <th style="width: 250px;">ADMINISTRATOR</th>
                        <th>REGISTER</th>
                        <th>PERMANENT</th>
                        <th>VISITING</th>
                        <th>TERMINATE</th>
                        <th>MODIFY</th>
                        <th>TRANSFER</th>
                        <th>STATUS</th>
                        <th>POSITION</th>
                        <th>GRADE</th>
                        <th style="border-radius: 0px 20px 0px 0px">OTHER</th>
                    </tr>
                    <?php
                        $totalRegisterCount = 0;
                        $totalPermanentCount = 0;
                        $totalVisitingCount = 0;
                        $totalTerminateCount = 0;
                        $totalModifyCount = 0;
                        $totalTransferCount = 0;
                        $totalStatusCount = 0;
                        $totalPositionCount = 0;
                        $totalGradeCount = 0;
                        $totalOtherCount = 0;

                        if (!empty($report_results)) {
                            foreach ($report_results as $row) { 
                                echo "<tr>";
                                echo "<td>" . $row['admin_ID'] . "</td>";
                                echo "<td>" . $row['admin_Name'] . "</td>";
                                echo "<td>" . $row['register_Count'] . "</td>";
                                echo "<td>" . $row['permanent_Count'] . "</td>";
                                echo "<td>" . $row['visiting_Count'] . "</td>";
                                echo "<td>" . $row['terminate_Count'] . "</td>";
                                echo "<td>" . $row['modify_Count'] . "</td>";
                                echo "<td>" . $row['transfer_Count'] . "</td>";
                                echo "<td>" . $row['status_Count'] . "</td>";
                                echo "<td>" . $row['position_Count'] . "</td>";
                                echo "<td>" . $row['grade_Count'] . "</td>";
                                echo "<td>" . $row['other_Count'] . "</td>";
                                echo "</tr>";

                                $totalRegisterCount += $row['register_Count'];
                                $totalPermanentCount += $row['permanent_Count'];
                                $totalVisitingCount += $row['visiting_Count'];
                                $totalTerminateCount += $row['terminate_Count'];
                                $totalModifyCount += $row['modify_Count'];
                                $totalTransferCount += $row['transfer_Count'];
                                $totalStatusCount += $row['status_Count'];
                                $totalPositionCount += $row['position_Count'];
                                $totalGradeCount += $row['grade_Count'];
                                $totalOtherCount += $row['other_Count'];
                            }
                        }
                        echo "<tr>";
                        echo "<td style='background-color: #1A43BF; color: white; border-radius: 0px 0px 0px 20px'></td>"; // Leave the first column empty
                        echo "<td style='background-color: #1A43BF; color: white; font-size: 11px; font-family: Verdana, sans-serif; font-weight: bold; text-shadow: 1px 1px 4px black;'>TOTAL</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalRegisterCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalPermanentCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalVisitingCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalTerminateCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalModifyCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalTransferCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalStatusCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalPositionCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black;'>$totalGradeCount</td>";
                        echo "<td style='background-color: #1A43BF; color: white; font-weight: bold; text-shadow: 1px 1px 4px black; border-radius: 0px 0px 20px 0px'>$totalOtherCount</td>";
                        echo "</tr>";
                    ?>
                </table>

                <br><br>

            </center>

        </div>
    </body>
</html>