<?php
    session_start();
    $loggedin = false;
    if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin'] ) {
        header('Location: home.php');
    }
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']){

    }

?>