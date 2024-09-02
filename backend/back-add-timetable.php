<?php
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

if (isset($_POST['submit'])) {

    $section_id = escape($_POST['section_id']);
    $day = array($_POST['monday'], $_POST['tuesday'], $_POST['wednesday'], $_POST['thursday'], $_POST['friday'], $_POST['saturday']);

    $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id'";
    $result = query($query);
    $count = mysqli_num_rows($result);
    if (!$count) {
        foreach ($day as $d) {
            $d = escape($d);
            $query = "INSERT INTO timetable (fk_section_id, day) VALUES ('$section_id', '$d')";
            $result = query($query);
        }
        $names = array('dm', 'dt', 'dw', 'dth', 'df', 'ds');
        $names1 = array('tm', 'tt', 'tw', 'tth', 'tf', 'ts');
        $names2 = array('bm', 'bt', 'bw', 'bth', 'bf', 'bs');
        for ($i = 1; $i < 10; $i++) {
            $var2 = 'time' . $i . '';
            $time = escape($_POST[$var2]);
            if (!empty($time)) {
                $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id'";
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

                    $query = "INSERT INTO periods (fk_section_id, fk_timetable_id, period_name, teacher_name, time)";
                    $query .= "VALUES ('$section_id', '$tb_id', '$period', '$teacher', '$time')";

                    $results = query($query);
                    $j++;
                }
            }
        }
    } else {
        $num = 0;
        foreach ($day as $d) {
            $d = escape($d);
            $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id' AND day='$d'";
            $resul = query($query);
            $row = mysqli_fetch_assoc($resul);
            $tb_id = $row['timetable_id'];
            $query = "SELECT * FROM periods WHERE fk_timetable_id='$tb_id'";
            $res = query($query);
            while ($rows = mysqli_fetch_assoc($res)) {
                $pid = $rows['period_id'];
                $query = "DELETE FROM periods WHERE period_id='$pid'";
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
                $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id'";
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

                    $query = "INSERT INTO periods (fk_section_id, fk_timetable_id, period_name, teacher_name, time)";
                    $query .= "VALUES ('$section_id', '$tb_id', '$period', '$teacher', '$time')";

                    $results = query($query);
                    $j++;
                }
            }
        }

    }
    redirect("../add-time-table.php");
}