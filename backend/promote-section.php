<?php
// get studetns of the section to be promoted
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
if (isset($_POST['section_id'])) {
    $section_id = escape($_POST['section_id']);

    // SQL query to search for matches
    $query = "SELECT sc.*, sp.name, sp.roll_no, ac.class_name, cs.section_name, cs.section_id FROM student_class as sc INNER JOIN ";
    $query .= "student_profile as sp ON sc.fk_student_id=sp.student_id ";
    $query .= "INNER JOIN all_classes as ac ON sc.fk_class_id=ac.class_id ";
    $query .= "INNER JOIN class_sections as cs ON sc.fk_section_id=cs.section_id ";
    $query .= "WHERE sc.fk_section_id='$section_id' AND sc.status='1' AND sc.fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $class = $row['class_name'] . ' ' . $row['section_name'];
            $matches[] = [
                'id' => $row['fk_student_id'],
                'name' => $row['name'],
                'roll_no' => $row['roll_no'],
                'class_sect' => $class,
                'section_id' => $row['section_id']
            ];
        }
    } else {
        $matches[] = [
            'message' => 'Class is empty, no students to Pass Out.'
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}
