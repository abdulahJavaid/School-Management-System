<?php
// Start the session and buffer output
session_start();
ob_start();

// Include the required files and functions
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {


    for ($i = 1; $i < 10; $i++) {

        $date_index = 'date' . $i . '';
        $subject_index = 'subject' . $i . '';
        $time_index = 'time' . $i . '';

        $date = $_POST[$date_index];
        $subject = $_POST[$subject_index];
        $time = $_POST[$time_index];

        $query = "INSERT INTO exam_schedule (fk_section_id, date, subject, time) VALUES ('1', '$date', '$subject', '$time')";
        $result = mysqli_query($conn, $query);
    }


    if ($result) {
        redirect("../add-exam-schedule.php");
    }
}
