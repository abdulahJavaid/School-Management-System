<?php
if (isset($_POST['download_class_result'])) {

    $exam_title_id = escape($_POST['exam_title_id']);
    $section_id = escape($_POST['section_id']);

    // Fetch school info
    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $result = mysqli_query($conn, $query);
    $school = mysqli_fetch_assoc($result);

    // School details and header
    $html = "<div style='clear:float;'><img style='float:left; margin: 10px; border-radius: 5%;' src='uploads/school-profile-uploads/{$school['image']}' height='155px' width='155px' alt='school-image'>";
    $html .= "<h1>{$school['name']}</h1><h5>{$school['address']}</h5><h5>{$school['contact']}</h5></div><br>";

    // <h5>{$school['email']}</h5>
    // Add table styles
    $html .= "<style>
        body { font-family: Arial, sans-serif; margin: 20px; margin-top: 0px; }
        .table-container { width: 100%; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; word-wrap: break-word; white-space: normal; }
        th { background-color: #f0f0f0; }
        @media print { body { margin: 0; padding: 0; } table { width: 100%; font-size: 12px; } }
    </style>";

    // getting the class result
    $query = "SELECT exam_result.*, exam_title.*, section_subjects.subject_name, student_profile.name, ";
    $query .= "student_profile.roll_no, student_class.fk_section_id, ";
    $query .= "class_sections.section_name, all_classes.class_name ";
    $query .= "FROM exam_result INNER JOIN exam_title ON ";
    $query .= "exam_result.fk_exam_title_id=exam_title.exam_title_id ";
    $query .= "INNER JOIN section_subjects ON ";
    $query .= "exam_result.fk_subject_id=section_subjects.subject_id ";
    $query .= "INNER JOIN student_profile ON ";
    $query .= "exam_result.fk_student_id=student_profile.student_id ";
    $query .= "INNER JOIN student_class ON ";
    $query .= "student_profile.student_id=student_class.fk_student_id ";
    $query .= "INNER JOIN class_sections ON ";
    $query .= "student_class.fk_section_id=class_sections.section_id ";
    $query .= "INNER JOIN all_classes ON ";
    $query .= "class_sections.fk_class_id=all_classes.class_id ";
    $query .= "WHERE exam_result.fk_exam_title_id='$exam_title_id' ";
    $query .= "AND class_sections.section_id='$section_id' AND exam_result.fk_client_id='$client' ";
    $query .= "ORDER BY exam_result.fk_student_id, exam_result.fk_subject_id";
    $get_result = query($query);

    $data = [];
    $colsapn = 3;
    while ($row = mysqli_fetch_assoc($get_result)) {
        $title_id = $row['fk_exam_title_id'];
        if (!isset($data[$title_id])) {
            $data[$title_id] = [
                'exam_title' => $row['exam_title'],
                'student_class' => $row['class_name'] . ' ' . $row['section_name'],
                'result_subjects' => [],
                'subject_marks' => [],
                'results' => []
            ];
        }
        if (!in_array($row['subject_name'], $data[$title_id]['result_subjects'])) {
            $data[$title_id]['result_subjects'][] = $row['subject_name'];
            $colsapn++;
        }
        if (!array_key_exists($row['subject_name'], $data[$title_id]['subject_marks'])) {
            $data[$title_id]['subject_marks'][$row['subject_name']] = $row['total_marks'];
        }
        if (!array_key_exists($row['fk_student_id'], $data[$title_id]['results'])) {
            $data[$title_id]['results'][$row['fk_student_id']] = [
                'student_roll_no' => $row['roll_no'],
                'student_name' => $row['name'],
                'student_marks' => []
            ];
        }
        $data[$title_id]['results'][$row['fk_student_id']]['student_marks'][$row['subject_name']] = [
            'obtained' => $row['obtained_marks'],
            'total' => $row['total_marks']
        ];
    }

    $html .= "<h2 style='clear:both;'>Class: {$data[$exam_title_id]['student_class']}</h2>";
    // Start results table
    $html .= "<table border='1'><thead><tr>
        <th class='text-center' colspan='$colsapn'><h2>{$data[$exam_title_id]['exam_title']}</h2></th>
    </tr><tr>
        <th>Reg#</th><th>Name</th>";

    // Display subject names as headers
    foreach ($data[$exam_title_id]['result_subjects'] as $subject) {
        $html .= "<th>$subject</th>";
    }
    $html .= "<th>Total</th></tr><tr class='text-center'><th colspan='2'>Marks</th>";

    // Display total marks for each subject
    $total_marks = 0;
    foreach ($data[$exam_title_id]['subject_marks'] as $marks) {
        $total_marks += $marks;
        $html .= "<td>$marks</td>";
    }
    $html .= "<td>$total_marks</td></tr></thead><tbody>";

    // Add student rows
    foreach ($data[$exam_title_id]['results'] as $student) {
        $html .= "<tr><td>{$student['student_roll_no']}</td><td>{$student['student_name']}</td>";
        $obtained_total = 0;
        foreach ($data[$exam_title_id]['result_subjects'] as $subject) {
            $obtained_marks = $student['student_marks'][$subject]['obtained'] ?? 0;
            $html .= "<td>$obtained_marks</td>";
            $obtained_total += $obtained_marks;
        }
        $html .= "<td>$obtained_total</td></tr>";
    }

    $html .= "</tbody></table>";

    // Add footer or signatures
    $html .= "<br><br><strong>Teacher:</strong> <u>___________________</u>
              &nbsp;&nbsp;&nbsp;&nbsp;<strong>Principal:</strong> <u>___________________</u>
              <br><br><strong>Dated:</strong> <u>___________________</u>";

    // fetching the admin id and adding the data
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> generated Exams Result of class <strong>{$data[$exam_title_id]['student_class']}</strong> !";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

    // Generate PDF
    $pdf_name = $data[$exam_title_id]['student_class'] . "-result" . ".pdf";
}
