<?php
    session_start();
    include "../iconTab.php";
    include "../sideNav.php";
    include "../connect.php";
    
    $monthNames = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    if (!isset($_REQUEST["day"])) $_REQUEST["day"] = date("d");
    if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
    if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");
 
    $cDay = $_REQUEST["day"];
    $cMonth = $_REQUEST["month"];
    $cYear = $_REQUEST["year"];
    $day = $_REQUEST['day'];

    $prev_year = $cYear;
    $next_year = $cYear;
    $prev_month = $cMonth - 1;
    $next_month = $cMonth + 1;

    if ($prev_month == 0) {
        $prev_month = 12;
        $prev_year = $cYear - 1;
    }
    if ($next_month == 13) {
        $next_month = 1;
        $next_year = $cYear + 1;
    }
?>

<style>
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

  .container {
    border-radius: 5px;
    padding: 20px;
    margin: 50px;
    width: 800px; /* Set the desired width */
  	max-width: 100%; /* Ensure the container doesn't exceed the viewport width */
  	margin: 0 auto;
	  padding: 20px;
    opacity: 95%;
    margin-top: 50px;
  }

  .container table{
    border-radius: 10px;
    width: 70%; 
    border: 10;
    padding: 5;
    border-spacing: 5;
    background-color: white;
  }

  .container table tr{
    column-width: 7; 
    text-align: center;
    color: white;
    background-color: #D21404;
  }

  .container table tr td {
    border: 3px solid black; /* Add border */
  }

  .container table tr td:hover {
    border: 3px solid grey;
    background-color: lightgray;
    cursor: pointer;
  }

  .container table tr td:hover a {
    color: white;
  }

  .container table tr.calendar-header td.arrow a {
    text-decoration: none; 
    color: white; 
    font-size: 25px; 
    font-weight: bold;
    text-shadow: 1px 1px 4px black;
  }

  .container table tr.calendar-header td.arrow:hover {
    background-color: #D21404;
    border: 3px solid black;
  }

  .container table tr.calendar-header td.months a {
    font-size: 20px; 
    font-weight:bold; 
    font-family: Helvetica; 
    text-transform: uppercase;
    text-shadow: 1px 1px 4px black;
  }

  .container table tr.calendar-header td.months:hover { 
    background-color: #D21404;
    cursor: default;
    border: 3px solid black;
  }

  .container table tr.days td {
    text-align: center;
    width: 100px; 
    background-color: #D21404;
    cursor: default;
    text-shadow: 1px 1px 4px black;
  }

  .container table tr.days td a {
    color: white; 
    font-family: Helvetica;
    text-shadow: 1px 1px 4px black;
  }

  .container table tr.days td:hover {
    border-color: black;
  }
 
  .container table tr td.past-date {
    cursor: default;
    pointer-events: none;
    color: grey;
    font-size: 20px;
    font-family: Arial;
  }

  .container table tr td.empty-cell {
    border: none; /* Remove border for empty cells */
  }

  .container table tr td.empty-cell:hover {
    background-color: white; /* Remove border for empty cells */
    cursor: default;
  }
</style>

<!DOCTYPE html>
<html>
    <body>
        <!-- Background -->
        <div class="background"><

            <div class="container">

                <center>
                    <table>
                        <tr class="calendar-header">
                          <td class="arrow">
                            <button style='text-decoration:none; color:white; font-weight:bold; font-size:23px; font-family:Arial; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href="<?php echo $_SERVER["PHP_SELF"] . "?month=" . $prev_month . "&year=" . $prev_year; ?>"'> < </button>
                          </td>
                          <td class="months" colspan="5">
                            <a><?php echo $monthNames[$cMonth - 1] . ' ' . $cYear; ?></a>
                          </td>
                          <td class="arrow">
                            <button style='text-decoration:none; color:white; font-weight:bold; font-size:23px; font-family:Arial; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href="<?php echo $_SERVER["PHP_SELF"] . "?month=" . $next_month . "&year=" . $next_year; ?>"'> > </button>
                          </td>
                        </tr>

                        <tr class="days">
                          <td><a>SUN</a></td>
                          <td><a>MON</a></td>
                          <td><a>TUE</a></td>
                          <td><a>WED</a></td>
                          <td><a>THU</a></td>
                          <td><a>FRI</a></td>
                          <td><a>SAT</a></td>
                        </tr>

                          <?php
                            $timestamp = mktime(0, 0, 0, $cMonth, 1, $cYear);
                            $maxday = date("t", $timestamp);
                            $thismonth = getdate($timestamp);
                            $startday = $thismonth['wday'];

                            for ($i = 0; $i < ($maxday + $startday); $i++) {
                              $j = $i - $startday + 1;
                              $today = $cYear . "-" . $cMonth . "-" . $cDay;
                              $currentDate = $cYear . "-" . $cMonth . "-" . $j;
                              $class = ($i < $startday) ? "empty-cell" : ""; // Add class for empty cells
                              $currentDate = $cYear . "-" . $cMonth . "-" . $j;
                              $isPastDate = strtotime($currentDate) < strtotime(date("Y-m-d"));
                              $isCurrentMonth = $cMonth == date("n");

                              if (($i % 7) == 0) echo "<tr>";
                              if ($i < $startday) echo "<td class='$class' bgcolor='white' width='80px' height='80px'></td>";
                              else {
                                if ($isPastDate) {
                                  echo "<td class='$class past-date' bgcolor='lightgrey' width='80px' height='80px'>" . ($i - $startday + 1) . "</td>";
                                }
                                elseif ($isCurrentMonth) {
                                  // Apply different style for past dates
                                  if ($isPastDate) {
                                    echo "<td class='$class past-date' bgcolor='lightgrey' width='80px' height='80px'>" . ($i - $startday + 1) . "</td>";
                                  } else {
                                    // Code for current and future dates (same as before)
                                    $sql = "SELECT * FROM reservation WHERE reserve_Date='$currentDate'";
                                    $reservations = mysqli_query($connect, $sql);
                                    $reservationCount = mysqli_num_rows($reservations);

                                    if ($j == $day && $reservationCount > 0) {
                                      echo "<td class='$class' bgcolor='#D21404' width='80px' height='80px'>";
                                      echo "<button style='text-decoration:none; color:white; font-weight:bold; font-size:30px; font-family:Arial; text-shadow: 1px 1px 4px black; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href=\"homeDetails.php?date=$currentDate\";'>";
                                      echo ($i - $startday + 1);
                                      echo "</button>";
                                      echo "</td>";
                                    } elseif ($j == $day) {
                                      echo "<td class='$class' bgcolor='#D21404' width='80px' height='80px'>";
                                      echo "<button style='text-decoration:none; color:white; font-weight:bold; font-size:30px; font-family:Arial; text-shadow: 1px 1px 4px black; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href=\"homeDetails.php?date=$currentDate\";'>";
                                      echo ($i - $startday + 1);
                                      echo "</button>";
                                      echo "</td>";
                                    } elseif ($reservationCount > 0) {
                                      echo "<td class='$class' bgcolor='white' width='80px' height='80px'>";
                                      echo "<button style='text-decoration:none; color:black; font-weight:bold; font-size:23px; font-family:Arial; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href=\"homeDetails.php?date=$currentDate\";'>";
                                      echo ($i - $startday + 1);
                                      echo "</button>";
                                      echo "</td>";
                                    } else {
                                      echo "<td class='$class' bgcolor='white' width='80px' height='80px'>";
                                      echo "<button style='text-decoration:none; color:black; font-weight:bold; font-size:23px; font-family:Arial; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href=\"homeDetails.php?date=$currentDate\";'>";
                                      echo ($i - $startday + 1);
                                      echo "</button>";
                                      echo "</td>";
                                    }
                                  }
                                } else {
                                  // Code for current and future dates (same as before)
                                  $sql = "SELECT * FROM reservation WHERE reserve_Date='$currentDate'";
                                  $reservations = mysqli_query($connect, $sql);
                                  $reservationCount = mysqli_num_rows($reservations);
                                  if ($reservationCount > 0) {
                                    echo "<td class='$class' bgcolor='white' width='80px' height='80px'>";
                                    echo "<button style='text-decoration:none; color:black; font-weight:bold; font-size:23px; font-family:Arial; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href=\"homeDetails.php?date=$currentDate\";'>";
                                    echo ($i - $startday + 1);
                                    echo "</button>";
                                    echo "</td>";
                                  } else {
                                    echo "<td class='$class' bgcolor='white' width='80px' height='80px'>";
                                    echo "<button style='text-decoration:none; color:black; font-weight:bold; font-size:23px; font-family:Arial; width: 100%; height: 100%; background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;' onclick='window.location.href=\"homeDetails.php?date=$currentDate\";'>";
                                    echo ($i - $startday + 1);
                                    echo "</button>";
                                    echo "</td>";
                                  }
                                }
                              }
                              if (($i % 7) == 6) echo "</tr>";
                            }
                          ?>
                    </table>
                </center>
            </div>
        </div>
    </body>
</html>