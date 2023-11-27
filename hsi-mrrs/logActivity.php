<?php
    include "connect.php";

    // Function to log user activity
    function logActivity($sID, $rID, $activity) {
        // Get the current timestamp in Malaysia
        $malaysiaTimezone = new DateTimeZone('Asia/Kuala_Lumpur');
        $now = new DateTime('now', $malaysiaTimezone);

        // Format the timestamp
        $timestamp = $now->format("Y-m-d H:i:s");
        $logMessage = $timestamp . " - User ID: " . $sID . " - Reservation ID: " . $rID . " - Activity: " . $activity . "\n";

        // Database connection details
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "hsi-mrrs";

        // Create a database connection
        $conn = mysqli_connect($host, $username, $password, $database);

        // Check if the connection was successful
        if (!$conn) {
            // Handle connection error
            error_log("Failed to connect to the database: " . mysqli_connect_error());
            return;
        }

        // Insert the log message into the log table
        $logTable = "log";
        $query = "INSERT INTO $logTable (log_Time, admin_Username, reserve_ID, log_Action) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $query);

        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "siss", $timestamp, $sID, $rID, $activity);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Close the statement and database connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
?>