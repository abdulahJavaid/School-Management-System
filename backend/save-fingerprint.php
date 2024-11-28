<?php
// save teachers fingerprints
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// getting the client id
$client = escape($_SESSION['client_id']);

// 
// 
// 
// 
// This page is no longer used
// 
// 
// 
// 
// 

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log the POST data for debugging
    // file_put_contents('../log.txt', print_r($_POST, true), FILE_APPEND);

    // Check if 'template' and 'fingerNumber' are set
    if (isset($_POST['template']) && isset($_POST['fingerNumber'])) {
        // Get the values from the POST request
        $template = $_POST['template'];
        $fingerNumber = $_POST['fingerNumber'];

        if ($fingerNumber == '1') {
            $finger_name = "right_thumb";
        } elseif ($fingerNumber == '2') {
            $finger_name = "right_index";
        } elseif ($fingerNumber == '3') {
            $finger_name = "left_thumb";
        } elseif ($fingerNumber == '4') {
            $finger_name = "left_index";
        }

        $teacher_id = $_POST['teacher_id'];

        $saved = check_finger($finger_name, $teacher_id);

        if ($saved == "no") {

            $query = "INSERT INTO teacher_fingers(fk_teacher_id, fingerprint, finger_name, fk_client_id) ";
            $query .= "VALUES('$teacher_id', '$template', '$finger_name', '$client')";
            $result = query($query);
        }

        // Process the data (e.g., save it, send it to a database, etc.)
        // For demonstration, let's just echo the values
        // echo "Template: " . htmlspecialchars($template) . "<br>";
        // echo "Finger Number: " . htmlspecialchars($fingerNumber);
    } else {
        redirect("../");
    }
} else {
    redirect("../");
}
