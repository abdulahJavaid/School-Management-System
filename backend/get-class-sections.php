<?php
// add class and sections page requests
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Check if 'query' is sent via POST
if (isset($_POST['class_id'])) {
    $class_id = escape($_POST['class_id']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT * FROM class_sections WHERE fk_class_id='$class_id'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $matches[] = [
            'id' => $row['section_id'],
            'name' => $row['section_name'] 
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

?>