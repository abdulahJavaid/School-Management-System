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

    // fetching the section id for which the time table is added
    $section_id = escape($_POST['section_id']);
    $query = "SELECT * FROM exam_schedule WHERE fk_section_id='$section_id'";

    $result = query($query);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        for ($i = 1; $i < 10; $i++) {

            $date_index = 'date' . $i . '';
            $subject_index = 'subject' . $i . '';
            $time_index = 'time' . $i . '';

            $date = escape($_POST[$date_index]);
            $subject = escape($_POST[$subject_index]);
            $time = escape($_POST[$time_index]);
            if (empty($time) || empty($subject) || empty($date)) {
                continue;
            }

            $query = "INSERT INTO exam_schedule (fk_section_id, date, subject, time) ";
            $query .= "VALUES ('$section_id', '$date', '$subject', '$time')";
            $result = mysqli_query($conn, $query);
        }
        redirect("../add-exam-schedule.php");
    } else {
        $query = "SELECT * FROM exam_schedule WHERE fk_section_id='$section_id'";
        $results = query($query);
        while ($row = mysqli_fetch_assoc($results)) {
            $exam_id = $row['exam_schedule_id'];
            $query = "DELETE FROM exam_schedule WHERE exam_schedule_id='$exam_id'";
            $result = query($query);
        }
        for ($i = 1; $i < 10; $i++) {

            $date_index = 'date' . $i . '';
            $subject_index = 'subject' . $i . '';
            $time_index = 'time' . $i . '';

            $date = escape($_POST[$date_index]);
            $subject = escape($_POST[$subject_index]);
            $time = escape($_POST[$time_index]);
            if (empty($time) || empty($subject) || empty($date)) {
                continue;
            }

            $query = "INSERT INTO exam_schedule (fk_section_id, date, subject, time) ";
            $query .= "VALUES ('$section_id', '$date', '$subject', '$time')";
            $result = mysqli_query($conn, $query);
        }
        redirect("../add-exam-schedule.php");
    }
}
