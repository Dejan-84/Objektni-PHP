<?php

session_start();


if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            
                    
    echo '<h2>Welcome ' .$_SESSION['email'].'</h2> <br>';
    echo '<button style="background-color:red;"><a style="color:white;text-decoration:none;"href="logout.php">Logout</a></button>';


}
?>    