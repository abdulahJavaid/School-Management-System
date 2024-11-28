<?php
// adding and updating the timetable
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// getting the client id
$client = escape($_SESSION['client_id']);

// add/update time table
if (isset($_POST['submit'])) {

    $class_name = escape($_POST['class']);
    $section_name = escape($_POST['section']);
    $section_id = escape($_POST['section_id']);
    $day = array($_POST['monday'], $_POST['tuesday'], $_POST['wednesday'], $_POST['thursday'], $_POST['friday'], $_POST['saturday']);

    $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id' AND fk_client_id='$client'";
    $result = query($query);
    $count = mysqli_num_rows($result);
    if (!$count) {
        foreach ($day as $d) {
            $d = escape($d);
            $query = "INSERT INTO timetable (fk_section_id, day, fk_client_id) VALUES ('$section_id', '$d', '$client')";
            $result = query($query);
        }
        $names = array('dm', 'dt', 'dw', 'dth', 'df', 'ds');
        $names1 = array('tm', 'tt', 'tw', 'tth', 'tf', 'ts');
        $names2 = array('bm', 'bt', 'bw', 'bth', 'bf', 'bs');
        for ($i = 1; $i < 10; $i++) {
            $var2 = 'time' . $i . '';
            $time = escape($_POST[$var2]);
            if (!empty($time)) {
                $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id' AND fk_client_id='$client'";
                $ans = query($query);
                $j = 0;
                while ($get = mysqli_fetch_assoc($ans)) {
                    $tb_id = escape($get['timetable_id']);
                    $var = $names[$j] . $i . '';
                    $var1 = $names1[$j] . $i . '';
                    $var3 = $names2[$j] . $i . '';
                    $period = escape($_POST[$var]);
                    $teacher = escape($_POST[$var1]);
                    if (empty($teacher) && empty($period)) {
                        $period = "!";
                        $teacher = "!";
                    } elseif (empty($period)) {
                        $period = "!";
                    } elseif (empty($teacher)) {
                        $teacher = "!";
                    } else {
                        $period = $period;
                        $teacher = $teacher;
                    }
                    if (isset($_POST[$var3])) {
                        $period = 'break';
                        $teacher = '!';
                    }

                    $query = "INSERT INTO periods (fk_section_id, fk_timetable_id, period_name, teacher_name, time, fk_client_id)";
                    $query .= "VALUES ('$section_id', '$tb_id', '$period', '$teacher', '$time', '$client')";

                    $results = query($query);
                    $j++;
                }
            }
        }
        // fetching the admin id and adding the data
        $id = escape($_SESSION['login_id']);
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> added new timetable for class <strong>$class_name $section_name</strong>!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);
    } else {
        $num = 0;
        foreach ($day as $d) {
            $d = escape($d);
            $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id' AND day='$d' AND fk_client_id='$client'";
            $resul = query($query);
            $row = mysqli_fetch_assoc($resul);
            $tb_id = $row['timetable_id'];
            $query = "SELECT * FROM periods WHERE fk_timetable_id='$tb_id' AND fk_client_id='$client'";
            $res = query($query);
            while ($rows = mysqli_fetch_assoc($res)) {
                $pid = $rows['period_id'];
                $query = "DELETE FROM periods WHERE period_id='$pid' AND fk_client_id='$client'";
                $result = query($query);
            }
        }
        $names = array('dm', 'dt', 'dw', 'dth', 'df', 'ds');
        $names1 = array('tm', 'tt', 'tw', 'tth', 'tf', 'ts');
        $names2 = array('bm', 'bt', 'bw', 'bth', 'bf', 'bs');
        for ($i = 1; $i < 10; $i++) {
            $var2 = 'time' . $i . '';
            $time = escape($_POST[$var2]);
            if (!empty($time)) {
                $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id' AND fk_client_id='$client'";
                $ans = query($query);
                $j = 0;
                while ($get = mysqli_fetch_assoc($ans)) {
                    $tb_id = escape($get['timetable_id']);
                    $var = $names[$j] . $i . '';
                    $var1 = $names1[$j] . $i . '';
                    $var3 = $names2[$j] . $i . '';
                    $period = escape($_POST[$var]);
                    $teacher = escape($_POST[$var1]);
                    if (empty($teacher) && empty($period)) {
                        $period = "!";
                        $teacher = "!";
                    } elseif (empty($period)) {
                        $period = "!";
                    } elseif (empty($teacher)) {
                        $teacher = "!";
                    } else {
                        $period = $period;
                        $teacher = $teacher;
                    }
                    if (isset($_POST[$var3])) {
                        $period = 'break';
                        $teacher = '!';
                    }

                    $query = "INSERT INTO periods (fk_section_id, fk_timetable_id, period_name, teacher_name, time, fk_client_id)";
                    $query .= "VALUES ('$section_id', '$tb_id', '$period', '$teacher', '$time', '$client')";

                    $results = query($query);
                    $j++;
                }
            }
        }
        // fetching the admin id and adding the data
        $id = escape($_SESSION['login_id']);
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> updated timetable for class <strong>$class_name $section_name</strong>!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);
    }
    redirect("../add-time-table.php");
}
