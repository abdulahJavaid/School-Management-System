<?php
// save teachers fingerprints
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

header('Content-Type: application/json');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if 'template' and 'fingerNumber' are set
    if (isset($_POST['school_id'])) {
        // Get the values from the POST request
        $school_id = $_POST['school_id'];
        $query = "SELECT * FROM school_profile_ WHERE id='$school_id'";
        $get_result = query($query);
        $row = mysqli_fetch_assoc($get_result);
        $_SESSION['school_id'] = $row['id'];
        $_SESSION['school_name'] = $row['name'];
        $_SESSION['client_id'] = $row['client_id'];
        // Send JSON response
        echo json_encode([
            'status' => 'success',
            'redirectUrl' => 'index.php'
        ]);
    } else {
        // Send JSON response
        echo json_encode([
            'status' => 'error',
            'message' => 'No data received'
        ]);
    }
} else {
    // Send JSON response
    echo json_encode([
        'status' => 'error',
        'message' => 'No data received'
    ]);
}