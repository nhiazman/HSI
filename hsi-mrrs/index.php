<?php
    include "connect.php";
    include "topNav.php";
    include "iconTab.php";
?>

<style>
    body {
        background-image: url("Images/7.jpg");
        background-size: cover;
        background-position: center;
        height: 760px;
        position: relative;
        margin: 0px;
    }

    /* Hide Scrollbar */
    ::-webkit-scrollbar {
        display: none;
    }
    
    .container {
        border-radius: 10px;
        padding: 0px;
        background-color: #fff;
        border: 1px solid #ccc;
        margin: 50px auto;
        max-width: 400px;
        text-align: center;
        margin-top: 57px;
        opacity: 96%;
    }
    
    .contact-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        background-color: #BF0000;
        color: #FFF;
        text-decoration: none;
        border-radius: 10px;
    }
    
    .contact-button i {
        margin-right: 5px;
    }
    
    .contact-button:hover {
        background-color: #cc0000;
    }
    
    .return {
        margin-top: 10px;
        color: #000;
        text-decoration: none;
    }
</style>

<!DOCTYPE html>
<html>
    <body>
        <nav class="topnav" id="myTopnav">
            <img src="Images/Logo/hsi.png">
            <a href="loginPage.php">
                <i class="fa fa-sign-in"></i>
            </a>
            <a href="calendarPage.php">
                <i class="fa fa-calendar"></i>
            </a>
            <a class="active" href="index.php">
                <i class="fa fa-home"></i>
            </a>
        </nav>
        
        <div class="container">
        
        <form style="border-radius: 20px;">
                    
            <table width = '130%'>

                <br>
                <h4 style="font-family:arial;">MEETING ROOM<br>RESERVATION SYSTEM<br>(MRRS)</h4>
                <img src="Images/Logo/hsi.png" alt="Company Logo" width="110" height="110">
                <br><br>
                <h4 style="font-size: 13px; font-family:Arial;">Please contact the administrator<br>below for room reservation. Thank you!</h4>
                <br>
                <?php
                    $sql = "SELECT 
                    administrator.admin_Name,
                    administrator.admin_Contact
                    FROM whatsapp
                        LEFT JOIN administrator
                        ON administrator.admin_ID = whatsapp.admin_ID
                    LIMIT 3";
                    $result = mysqli_query($connect, $sql);
                
                    if(mysqli_num_rows($result) > 0) {
                        foreach($result as $row) { 
                        
                            $aName = $row['admin_Name'];
                            $aCont = $row['admin_Contact'];
                            $message = "Tolong%20assist%20saya%20book%20bilik.%20Terima%20kasih.";
                            $url = "https://wa.me/+$aCont?text=$message";
                        
                            echo '<h4 style="font-size: 13px; font-family:Arial;">DIRECT MESSAGE:</h4>';
                            echo '<a style= "font-size: 14px;" href="'.$url.'" target="_blank" class="contact-button"><i class="fab fa-whatsapp"></i>'.$aName.'</a>';
                            echo '<br><br><h4 style="font-size: 13px; font-family:Arial;">EXTENSIONS:</h4>';
                            echo '<h4 style="font-size: 13px; font-family:Arial;"><i class="fa fa-phone"></i>&nbsp&nbsp1201</h4>';
                            echo '<h4 style="font-size: 13px; font-family:Arial;"><i class="fa fa-phone"></i>&nbsp&nbsp1202</h4>';
                            echo '<h4 style="font-size: 13px; font-family:Arial;"><i class="fa fa-phone"></i>&nbsp&nbsp1203</h4>';
                        }
                    }
                ?>
            </table>
        </form>
        </div>
    </body>
</html>

<?php 
    if(isset($_SESSION["error"])){
        unset ($_SESSION["error"]);
    }
?>

<script>
    window.onscroll = function() { myFunction() };

    var navbar = document.getElementById("myTopnav");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>