<?php
// managing the subscription processes
// add the new school to the database
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// getting the client id
$client = escape($_SESSION['client_id']);

// to request the student subscription
if (isset($_POST['request_sub'])) {
    $std_id = $_POST['request_sub']; // the student id

    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $get_school = query($query);
    $school = mysqli_fetch_assoc($get_school);
    $amount = $school['sub_amount'];
    $stake = $school['codsmine_stake'];

    $query = "INSERT INTO student_subscriptions(sub_status, ";
    $query .= "VALUES('requested', ";

    $matches = [];
    if (mysqli_num_rows($result) != 0) {
        $matches[] = ['msg' => "Client Id already taken!"];
    }else{
        $matches[] = ['msg' => "Client Id is available!"];
    }
    
    echo json_encode($matches);
}

?>