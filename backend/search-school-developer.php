<?php
// search school profiles
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if 'query' is sent via POST
// if (isset($_POST['query'])) {
    $searchQuery = escape($_POST['query']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT name FROM school_profile_ WHERE name LIKE '%$searchQuery%' LIMIT 10";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array
    while ($row = mysqli_fetch_assoc($result)) {
        $matches[] = $row;
    }

    // Return the results as a JSON response
    echo json_encode($matches);
// }
?>