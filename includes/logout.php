<?php
    // inclusion of required files and functions
    session_start();
    ob_start();
    require_once('../db_connection/configs.php');
    require_once('../db_connection/connection.php');
    require_once('./functions.php');

    // code to logout the user

    if(isset($_GET['get']) && $_GET['get'] == 'yes'){ // if the request is valid
        unset($_SESSION['login_access']);
        unset($_SESSION['login_id']);
        redirect('../');
    }else{ // if the request is not valid
        redirect('../');
    }
?>