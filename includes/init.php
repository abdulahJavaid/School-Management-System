<?php
    // include init file in every page as it will contain all the files necessary

    session_start(); // for the use fo $_SESSION super global
    ob_start(); // output buffering for redirection

    // necessary files
    require_once("db_connection/configs.php"); // database connection constants
    require_once("db_connection/connection.php"); // database connection
    require_once("functions.php"); // all the functions for my school system


    // parameter files for easier management
    // require_once("parameters/class_sections.php"); // specify how many classes and sections for each class

?>