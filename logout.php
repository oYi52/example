<?php 
    session_start();
    /*unset($_SESSION['user']);
    unset($_SESSION['role']);
    unset($_SESSION['name']);*/
    session_destroy();
    header("Location:index.php?attempt=1");
?>