<?php
// search teacher profiles
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Set the content type to JSON
header('Content-Type: application/json');

// getting the client id
$client = escape($_SESSION['client_id']);

// Check if 'query' is sent via POST
if (isset($_POST['allquery'])) {
    // $searchQuery = escape($_POST['allquery']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT * FROM teacher_profile WHERE teacher_status='1' AND fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $matches[] = [
            'id' => $row['teacher_id'],
            'name' => $row['name']
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// Check if 'query' is sent via POST
if (isset($_POST['query'])) {
    $searchQuery = escape($_POST['query']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT teacher_id, name FROM teacher_profile WHERE name LIKE '$searchQuery%' ";
    $query .= "AND teacher_status='1' AND fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $matches[] = [
            'id' => $row['teacher_id'],
            'name' => $row['name']
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}
