<?php
    session_start();
    if(isset($_SESSION['access'])){
        unset($_SESSION['access']);
    }
    header("location:Login.php");
        die();
?>