<?php
    include "connect.php";
    include "iconTab.php";
    include "topNav.php";

    // Initialize a variable to store the search query and a flag to check if results were found
    $searchQuery = "";
    $resultsFound = false;

    // Check if the form was submitted
    if (isset($_POST['formSubmitted'])) {
        $searchQuery = $_POST['searchInput'];

        // Perform a database query to search for staff by staff_ID
        $sql = "SELECT * FROM staff WHERE staff_ID = '$searchQuery'";
        $result = mysqli_query($connect, $sql);

        // Check if any results were found
        if (mysqli_num_rows($result) > 0) {
            $resultsFound = true;

            // Store the search results in the array
            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }

            // Store the search results in a session variable
            $_SESSION['searchResults'] = $searchResults;
        } 
    }

    // Check if there are stored search results in the session
    if (isset($_SESSION['searchResults'])) {
        $resultsFound = true;
        $result = $_SESSION['searchResults'];
    }

    if (isset($_POST['clear'])) {
        unset($_SESSION['searchResults']); // Clear the search results
        $resultsFound = false;
    }    
?>

<style>
    /* Hide Scrollbar */
    ::-webkit-scrollbar {
        display: none;
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: #ffffff;
        z-index: 999; /* Make sure it's above other elements */
        padding: 10px;
        text-align: center;
    }

    .container h1 {
        color: #000;
        font-family: 'Arial';
        font-size: 30px;
        /* text-shadow: 10px 10px 5px black; */
        text-transform: uppercase;
    }

    .container img {
        height: 130px;
        width: 130px;
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
        width: 90%;
        background: white;
        border-radius: 20px 20px 0px 0px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        font-weight: bold ;
        color: black;
        text-align: center;
        opacity: 97%;
    }

    .myTable th {
        font-family: Verdana, sans-serif;
        text-shadow: 1px 1px 4px black;
        font-size: 15px;
        height: 30px;
        letter-spacing: 0.05em;
        background-color: #1A43BF;
        color: white;
        text-align: center;
        position: sticky;
        top: 0;
    }

    .myTable td, .myTable th {
        padding: 5px;
        border: 1px solid #000;
        overflow-wrap: break-word;
        word-wrap: break-word;
        text-align: center;
        text-transform: uppercase;
    }

    .myTable input {
        font-size: 15px;
		width: 100px; /* Adjust the width as needed */
		height: 30px; /* Adjust the height as needed */
		margin-top: 5px; /* Adjust the margin as needed */
		margin-bottom: 5px; /* Adjust the margin as needed */
    }

    .search {
        text-align: center;
    }

    .search input {
        text-align: center;
    }

    #searchInput {
		padding: 10px;
        width: 400px; /* Adjust the width as needed */
        border-radius: 5px;
        font-size: 15px;
	}

    #searchButton {
        padding: 8px 37px;
        margin-left: 15px;
        background-color: #1A43BF;
        color: white;
        border: 0.5px normal;
        border-color: black;
        cursor: pointer;
        border-radius: 10px;
        font-size: 13px;
    }

    #searchButton:hover {
        background-color: darkblue;
        color: #fff;
    }

    #clearButton {
        padding: 8px 40px;
        background-color: white;
        color: black;
        border: 0.5px normal; 
        border-color: black;
        cursor: pointer;
        border-radius: 10px;
        font-size: 13px;
    }

    #clearButton:hover {
        background-color: #ddd;
        color: #000;
    }    
</style>

<!DOCTYPE html>
<html>
    <body>
        <nav class="topnav" id="myTopnav">
            <a href="loginPage.php">
                <i class="fa fa-sign-in"></i>
            </a>
            <a class="active" href="index.php">
                <i class="fa fa-search"></i>
            </a>
        </nav>

        <div class="background">
            
            <div class="container"><br><br><br><br>

            <center><img src="Images/logo.png"></center>
            <center><h1>STAFF INFORMATION SYSTEM<br>(SIS)</h1></center>

            <br><br>

            <form method="POST" action="" id="searchForm">
                <div class="search">
                    <input type="text" id="searchInput" name="searchInput" placeholder="Enter IC / Passport Number" value="<?php echo $searchQuery; ?>" required>
                    <br><br><br>
                    <!-- Use a regular button for clearing -->
                    <button id="clearButton" type="button" onclick="location.href='index.php'">CLEAR</button>
                    <button id="searchButton" type="button" onclick="performSearch()">SEARCH</button>
                    
                    <input type="hidden" name="formSubmitted" value="1">
                </div>
                <!-- Error message div -->
                <div id="errorMessage" style="color: red; display: none;"><br><br><center>Please fill in the search field.<center></div>
            </form>

            <br><br>

            <center>
                <?php
                    if ($resultsFound) {
                        echo '<table class="myTable">';
                        echo '<hr>';
                        echo '<br><br>';
                        echo '<tr>';
                        echo '<th style="border-radius: 20px 0px 0px 0px">IC / PASSPORT NUMBER</th>';
                        echo '<th>NAME</th>';
                        echo '<th style="border-radius: 0px 20px 0px 0px">ACTION</th>';
                        echo '</tr>';

                        foreach ($searchResults as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['staff_ID'] . '</td>';
                            echo '<td>' . $row['staff_Name'] . '</td>';
                            echo '<td><input class="custom-button" type="button" onclick="location.href=\'viewStaff.php?staff_ID=' . $row['staff_ID'] . '\'" value="View"></td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } elseif (isset($_POST['formSubmitted'])) {
                        // Display "No results found" message when the form is submitted and no results are found
                        echo '<div style="text-align:center;color:red;">No results found.</div>';
                    }
                ?>
            </center>
            
        </div>
    </body>
</html>

<script>
    function performSearch() {
        var searchInput = document.getElementById('searchInput').value;
        if (searchInput.trim() === '') {
            // Show the error message and hide it after a few seconds
            var errorMessage = document.getElementById('errorMessage');
            errorMessage.style.display = 'block';
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 3000); // Hide the message after 3 seconds
        } else {
            // Submit the form if the search field is not empty
            document.getElementById('searchForm').submit();
        }
    }
</script>