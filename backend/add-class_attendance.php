<?php
// add class attendance
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// when the attendance is submitted
if (isset($_POST['submit'])) {
    // $count = count($_POST);
    $class = $_POST['class'];
    $section = $_POST['section'];

    // necessary
    $query = "SELECT * FROM all_classes INNER JOIN class_sections ON ";
    $query .= "all_classes.class_id = class_sections.fk_class_id INNER JOIN ";
    $query .= "student_class ON class_sections.section_id = student_class.fk_section_id ";
    $query .= "INNER JOIN student_profile ON student_class.fk_student_id = student_profile.student_id ";
    $query .= "WHERE class_id = '$class' AND section_id = '$section'";

    $result = query($query);
    while($row = mysqli_fetch_assoc($result)){
        $sid = $row['student_id'];
        $var = 'attendance' . $sid . '';

        $att = $_POST[$var];
        $date = date('Y/m/d', time());
        $time = strtotime($date);
        $date = date('Y-m-d', $time);
        $query = "INSERT INTO attendance(fk_student_id, attendance, date) ";
        $query .= "VALUES('$sid', '$att', '$date')";

        $res = query($query);
    }
    redirect("../add-attendance.php");

    // foreach ($count as $cunt) {
    // }
}


?>