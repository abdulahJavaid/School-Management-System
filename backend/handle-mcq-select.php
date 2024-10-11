<?php
// mcq page rquests
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if 'query' is sent via POST
if (isset($_POST['board_id'])) {
    $board_id = escape($_POST['board_id']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT * FROM board_class WHERE fk_board_id='$board_id'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $matches[] = [
            'id' => $row['board_class_id'],
            'name' => $row['board_class_name'] 
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// Check if 'query' is sent via POST
if (isset($_POST['class_id'])) {
    $class_id = escape($_POST['class_id']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT * FROM board_subject WHERE fk_board_class_id='$class_id'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $matches[] = [
            'id' => $row['subject_id'],
            'name' => $row['subject_name'] 
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// Check if 'query' is sent via POST
if (isset($_POST['subject_id'])) {
    $subject_id = escape($_POST['subject_id']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT * FROM chapters WHERE fk_subject_id='$subject_id'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $matches[] = [
            'id' => $row['chapter_id'],
            'name' => $row['chapter_name'],
            'number' => $row['chapter_number']
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}
?>