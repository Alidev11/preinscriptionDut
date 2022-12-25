<?php 
        session_start();
        session_unset();
        session_destroy();
        echo "Redirecting...";
        header("Location:login.php");
?>