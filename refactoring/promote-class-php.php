<?php
// form handling requests of promote-class.php

// pass out a class
if (isset($_POST['pass_out'])) {
    $section_id = escape($_POST['section_id']);
    $class_section = escape($_POST['class_section']);
    // query for the students of the selected section
    $query = "UPDATE student_profile ";
    $query .= "INNER JOIN student_class ON student_profile.student_id=student_class.fk_student_id ";
    $query .= "SET student_status='0' ";
    $query .= "WHERE fk_section_id='$section_id' AND student_class.fk_client_id='$client'";
    $make_students_alumini = query($query);

    if ($make_students_alumini) {
        // query for disabling student classes
        $query = "UPDATE student_class SET `status`='0' ";
        $query .= "WHERE fk_section_id='$section_id' AND fk_client_id='$client'";
        $disable_student_classes = query($query);

        if ($disable_student_classes) {    
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> passed out the students of <strong>$class_section</strong>!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

            redirect("./promote-class.php?passOut=done");
        }
    }
}

// promote a class
if (isset($_POST['promote'])) {
    $section_id = escape($_POST['section_id']);
    $class_section = escape($_POST['class_section']);
    $p_section_id = escape($_POST['promotion_section']);
    // getting the class id of the section
    $query = "SELECT ac.class_name, ac.class_id, cs.section_name FROM class_sections AS cs ";
    $query .= "INNER JOIN all_classes AS ac ON cs.fk_class_id=ac.class_id ";
    $query .= "WHERE section_id='$section_id' AND cs.fk_client_id='$client'";
    $get_promotion_section = query($query);
    $get_p_class_section = mysqli_fetch_assoc($get_promotion_section);
    $p_class_id = $get_p_class_section['class_id'];
    $p_class_section = $get_p_class_section['class_name'] . ' ' . $get_p_class_section['section_name'];

    // getting the students of the class to be promoted
    $query = "SELECT fk_student_id FROM student_class ";
    $query .= "WHERE fk_section_id='$section_id' AND fk_client_id='$client'";
    $get_std_ids = query($query);
    while ($row = mysqli_fetch_assoc($get_std_ids)) {
        $student_id = $row['fk_student_id'];
        // promote the student to next class
        $query = "INSERT INTO student_class(fk_student_id, fk_class_id, fk_section_id, fk_client_id) ";
        $query .= "VALUES('$student_id', '$p_class_id', '$p_section_id', '$client')";
        $promote_to_new_class = query($query);
    }

    // disabling student previous class
    $query = "UPDATE student_class SET `status`='0' ";
    $query .= "WHERE fk_section_id='$section_id' AND fk_client_id='$client'";
    $disable_student_class = query($query);

    if ($disable_student_class) {
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> promoted students from <strong>$class_section</strong> to <strong>$p_class_section</strong>!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

        redirect("promote-class.php?promote=done");
    }

}
