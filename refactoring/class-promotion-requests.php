<?php
// form handling requests of promote-class.php

// pass out a class
if (isset($_POST['pass_out'])) {
    $section_id = escape($_POST['section_id']);
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
            redirect("./promote-class.php?passOut=done");
        }
    }
}
