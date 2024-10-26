<?php
// student results page
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
if (isset($_POST['roll_no'])) {
    $roll_no = escape($_POST['roll_no']);

    // SQL query to search for matches (adjust based on your table structure)
    $query = "SELECT exam_result.fk_exam_title_id, student_profile.roll_no, exam_title.exam_title ";
    $query .= "FROM exam_result INNER JOIN student_profile ON ";
    $query .= "exam_result.fk_student_id=student_profile.student_id ";
    $query .= "INNER JOIN exam_title ON exam_result.fk_exam_title_id=exam_title.exam_title_id ";
    $query .= "WHERE exam_result.fk_student_id='$roll_no' AND exam_result.fk_client_id='$client' ";
    $query .= "ORDER BY exam_result.fk_exam_title_id DESC";
    $result = query($query);

    $matches = [];
    if (mysqli_num_rows($result) != 0) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $title_id = $row['fk_exam_title_id'];
            $title = $row['exam_title'];
            if (!isset($data[$title_id])) {
                $data[$title_id] = $title;
            }
        }

        // Fetch results and store them in the $matches array$results = [];
        foreach ($data as $key => $val) {
            $matches[] = [
                'id' => $key,
                'name' => $val
            ];
        }
    } else {
        $matches[] = [
            'id' => 'no-match',
            'name' => 'No Result'
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}
