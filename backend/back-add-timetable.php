<?php
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

if (isset($_POST['submit'])) {

    $section_id = $_POST['section_id'];
    $day = array($_POST['monday'], $_POST['tuesday'], $_POST['wednesday'], $_POST['thursday'], $_POST['friday'], $_POST['saturday']);

    $query = "SELECT * FROM timetable WHERE fk_section_id='$section_id'";
    $result = query($query);
    $count = mysqli_num_rows($result);
    if (!$count) {
        $num = 0;
        foreach ($day as $d) {
            $query = "INSERT INTO timetable (fk_section_id, day) VALUES ('$section_id', '$d')";
            $result = query($query);
            if ($result) {
                $tb_id = mysqli_insert_id($conn);
                $names = array('dm', 'dt', 'dw', 'dth', 'df', 'ds');
                $names1 = array('tm', 'tt', 'tw', 'tth', 'tf', 'ts');
                $names2 = array('bm', 'bt', 'bw', 'bth', 'bf', 'bs');
                for ($j = 1; $j < 10; $j++) {
                    $var = $names[$num] . $j . '';
                    $var1 = $names1[$num] . $j . '';
                    $var2 = 'time' . $j . '';
                    $var3 = $names2[$num] . $j . '';
                    $period = $_POST[$var];
                    $teacher = $_POST[$var1];
                    if (empty($teacher) && empty($period)) {
                        $period = "---";
                    } elseif (empty($period)) {
                        $period = "subject not-assigned - " . $teacher . "";
                    } elseif (empty($teacher)) {
                        $period .= " - teacher not-assigned";
                    } else {
                        $period .= ' - ' . $teacher . '';
                    }
                    if (isset($_POST[$var3])) {
                        $period = 'break';
                    }
                    $time = $_POST[$var2];
                    if (!empty($time)) {
                        $query = "INSERT INTO periods (fk_section_id, fk_timetable_id, period_name, time)";
                        $query .= "VALUES ('$section_id', '$tb_id', '$period', '$time')";

                        $results = query($query);
                    }
                }
            }
            $num++;
        }
    } else {
        $num = 0;
        foreach ($day as $d) {
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
            $names = array('dm', 'dt', 'dw', 'dth', 'df', 'ds');
            $names1 = array('tm', 'tt', 'tw', 'tth', 'tf', 'ts');
            $names2 = array('bm', 'bt', 'bw', 'bth', 'bf', 'bs');
            for ($j = 1; $j < 10; $j++) {
                $var = $names[$num] . $j . '';
                $var1 = $names1[$num] . $j . '';
                $var2 = 'time' . $j . '';
                $var3 = $names2[$num] . $j . '';
                $period = $_POST[$var];
                $teacher = $_POST[$var1];
                if (empty($teacher) && empty($period)) {
                    $period = "---";
                } elseif (empty($period)) {
                    $period = "subject not-assigned - " . $teacher . "";
                } elseif (empty($teacher)) {
                    $period .= " - teacher not-assigned";
                } else {
                    $period .= ' - ' . $teacher . '';
                }
                if (isset($_POST[$var3])) {
                    $period = 'break';
                }
                $time = $_POST[$var2];
                if (!empty($time)) {
                    $query = "INSERT INTO periods (fk_section_id, fk_timetable_id, period_name, time)";
                    $query .= "VALUES ('$section_id', '$tb_id', '$period', '$time')";

                    $results = query($query);
                }
            }
            $num++;
        }
    }
    redirect("../add-time-table.php");
}
