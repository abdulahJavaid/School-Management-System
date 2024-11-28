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

    // SQL query to search for matches (adjust based on table structure)
    $query = "SELECT exam_result.fk_exam_title_id, student_profile.roll_no, exam_title.exam_title ";
    $query .= "FROM exam_result INNER JOIN student_profile ON ";
    $query .= "exam_result.fk_student_id=student_profile.student_id ";
    $query .= "INNER JOIN exam_title ON exam_result.fk_exam_title_id=exam_title.exam_title_id ";
    $query .= "WHERE exam_result.fk_student_id='$roll_no' AND student_profile.student_status='1' AND exam_result.fk_client_id='$client' ";
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

// Check if 'query' is sent via POST
if (isset($_POST['date'])) {
    $date = escape($_POST['date']);
    $timestamp = strtotime($date);
    $exam_month = date('F', $timestamp);
    $exam_year = date('Y', $timestamp);

    // SQL query to search for matches (adjust based on table structure)
    $query = "SELECT exam_result.fk_exam_title_id, exam_title.exam_title ";
    $query .= "FROM exam_result ";
    $query .= "INNER JOIN exam_title ON exam_result.fk_exam_title_id=exam_title.exam_title_id ";
    $query .= "WHERE exam_title.exam_month='$exam_month' AND exam_title.exam_year='$exam_year' ";
    $query .= "AND exam_result.fk_client_id='$client' ";
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

// Check if 'query' is sent via POST
if (isset($_POST['section'])) {
    $section = escape($_POST['section']);

    // SQL query to search for matches (adjust based on table structure)
    $query = "SELECT exam_result.fk_exam_title_id, exam_title.exam_title ";
    $query .= "FROM exam_result INNER JOIN student_profile ON ";
    $query .= "exam_result.fk_student_id=student_profile.student_id ";
    $query .= "INNER JOIN student_class ON ";
    $query .= "student_profile.student_id=student_class.fk_student_id ";
    $query .= "INNER JOIN exam_title ON exam_result.fk_exam_title_id=exam_title.exam_title_id ";
    $query .= "WHERE student_class.fk_section_id='$section' ";
    $query .= "AND student_profile.student_status='1' ";
    $query .= "AND student_class.status='1' ";
    $query .= "AND exam_result.fk_client_id='$client' ";
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

// Check if 'query' is sent via POST
if (isset($_POST['bothDate']) && isset($_POST['bothSection'])) {
    $section = escape($_POST['bothSection']);
    $date = escape($_POST['bothDate']);
    $timestamp = strtotime($date);
    $exam_month = date('F', $timestamp);
    $exam_year = date('Y', $timestamp);

    // SQL query to search for matches (adjust based on table structure)
    $query = "SELECT exam_result.fk_exam_title_id, exam_title.exam_title ";
    $query .= "FROM exam_result INNER JOIN student_profile ON ";
    $query .= "exam_result.fk_student_id=student_profile.student_id ";
    $query .= "INNER JOIN student_class ON ";
    $query .= "student_profile.student_id=student_class.fk_student_id ";
    $query .= "INNER JOIN exam_title ON exam_result.fk_exam_title_id=exam_title.exam_title_id ";
    $query .= "WHERE student_class.fk_section_id='$section' ";
    $query .= "AND student_profile.student_status='1' ";
    $query .= "AND student_class.status='1' ";
    $query .= "AND exam_title.exam_month='$exam_month' AND exam_title.exam_year='$exam_year' ";
    $query .= "AND exam_result.fk_client_id='$client' ";
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
