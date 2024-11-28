<?php
// Backend code to add the exam schedule
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// getting the client id
$client = escape($_SESSION['client_id']);

// Check if the form is submitted to add new exam schedule
if (isset($_POST['submit'])) {

    $exam_title = escape($_POST['exam_title']);
    // if (!empty($exam_title)) {
    $query = "INSERT INTO exam_title(exam_title, fk_client_id) VALUES('$exam_title', '$client')";
    $insert_title = query($query);
    if ($insert_title) {
        $exam_title_id = last_id();
    }
    // } else {
    //     redirect("../add-exam-schedule.php");
    // }
    $class_name = escape($_POST['class']);
    $section_name = escape($_POST['section']);
    $section_id = escape($_POST['section_id']);

    $update_once = 0;
    for ($i = 1; $i < 10; $i++) {
        // creating indexes for daynamic names
        $exam_time = 'exam_time' . $i . '';
        $subject_id = 'subject_id' . $i . '';
        $exam_date = 'exam_date' . $i . '';
        $submission_date = 'submission_date' . $i . '';
        $teacher_id = 'teacher_id' . $i . '';
        // fetching data from POST super global
        $exam_time = escape($_POST[$exam_time]);
        $subject_id = escape($_POST[$subject_id]);
        $exam_date = escape($_POST[$exam_date]);
        $submission_date = escape($_POST[$submission_date]);
        $teacher_id = escape($_POST[$teacher_id]);
        // if any field is empty do not add the record
        if (empty($exam_time) || empty($subject_id) || empty($exam_date) || empty($submission_date) || empty($teacher_id)) {
            continue;
        } else {
            // updatign exam title to add the exam_month and _year
            if ($update_once == 0) {
                $time_stamp = strtotime($exam_date);
                $exam_year = date('Y', $time_stamp);
                $exam_month = date('F', $time_stamp);

                $query = "UPDATE exam_title SET exam_year='$exam_year', exam_month='$exam_month' ";
                $query .= "WHERE exam_title_id='$exam_title_id'";
                $update_exam_title = query($query);
                if ($update_exam_title) {
                    $update_once = 1;
                }
            }
        }

        // Inserting the exam schedule one by one
        $query = "INSERT INTO exam_schedule (fk_section_id, fk_exam_title_id, fk_subject_id, ";
        $query .= "fk_teacher_id, exam_date, exam_time, submission_date, fk_client_id) ";
        $query .= "VALUES ('$section_id', '$exam_title_id', '$subject_id', ";
        $query .= "'$teacher_id', '$exam_date', '$exam_time', '$submission_date', '$client')";
        $result = mysqli_query($conn, $query);
    } // end of loop

    // fetching the admin id and adding the data
    $id = escape($_SESSION['login_id']);
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> added exam schedule for class <strong>$class_name $section_name</strong>!";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);
    redirect("../add-exam-schedule.php");
}

// update exam schedule
if (isset($_POST['update'])) {

    $exam_title_id = escape($_POST['exam_title_id']);
    $exam_title = escape($_POST['exam_title']);
    // if (!empty($exam_title)) {
    $query = "UPDATE exam_title SET exam_title='$exam_title' WHERE exam_title_id='$exam_title_id' ";
    $query .= "AND fk_client_id = '$client'";
    $update_title = query($query);
    if ($update_title) {
        // $exam_title_id = last_id();
    }
    // } else {
    //     redirect("../add-exam-schedule.php");
    // }
    $class_name = escape($_POST['class']);
    $section_name = escape($_POST['section']);
    $section_id = escape($_POST['section_id']);

    $update_once = 0;
    for ($i = 1; $i < 10; $i++) {
        // creating indexes for daynamic names
        $exam_schedule_id = 'exam_schedule_id' . $i . '';
        $exam_time = 'exam_time' . $i . '';
        $subject_id = 'subject_id' . $i . '';
        $exam_date = 'exam_date' . $i . '';
        $submission_date = 'submission_date' . $i . '';
        $teacher_id = 'teacher_id' . $i . '';
        // fetching data from POST super global
        $exam_schedule_id = escape($_POST[$exam_schedule_id]);
        $exam_time = escape($_POST[$exam_time]);
        $subject_id = escape($_POST[$subject_id]);
        $exam_date = escape($_POST[$exam_date]);
        $submission_date = escape($_POST[$submission_date]);
        $teacher_id = escape($_POST[$teacher_id]);
        // if any field is empty do not add the record
        if (empty($exam_time) || empty($subject_id) || empty($exam_date) || empty($submission_date) || empty($teacher_id)) {
            continue;
        } else {
            // updatign exam title to add the exam_month and _year
            if ($update_once == 0) {
                $time_stamp = strtotime($exam_date);
                $exam_year = date('Y', $time_stamp);
                $exam_month = date('F', $time_stamp);

                $query = "UPDATE exam_title SET exam_year='$exam_year', exam_month='$exam_month' ";
                $query .= "WHERE exam_title_id='$exam_title_id' AND fk_client_id='$client'";
                $update_exam_title = query($query);
                if ($update_exam_title) {
                    $update_once = 1;
                }
            }
        }

        // Inserting the exam schedule one by one
        $query = "UPDATE exam_schedule SET fk_section_id='$section_id', ";
        $query .= "fk_exam_title_id='$exam_title_id', fk_subject_id='$subject_id', ";
        $query .= "fk_teacher_id='$teacher_id', exam_date='$exam_date', ";
        $query .= "exam_time='$exam_time', submission_date='$submission_date' ";
        $query .= "WHERE exam_schedule_id='$exam_schedule_id' ";
        $query .= "AND fk_client_id='$client'";
        $result = mysqli_query($conn, $query);
    } // end of loop

    // fetching the admin id and adding the data
    $id = escape($_SESSION['login_id']);
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> updated exam schedule for class <strong>$class_name $section_name</strong>!";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;

    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);
    redirect("../add-exam-schedule.php");
}
// }
