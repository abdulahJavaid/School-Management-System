<?php
if (isset($_POST['download_student_result'])) {

    $exam_title_id = escape($_POST['exam_title_id']);
    $roll_no = escape($_POST['roll_no']);

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

    // getting the student result
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
    $query .= "AND student_profile.roll_no='$roll_no' AND exam_result.fk_client_id='$client'";
    $get_result = query($query);

    $data = [];
    while ($row = mysqli_fetch_assoc($get_result)) {
        $title_id = $row['fk_exam_title_id'];
        if (!isset($data[$title_id])) {
            $data[$title_id] = [];
            $data[$title_id] = [
                'exam_title' => $row['exam_title'],
                'student_name' => $row['name'],
                'student_class' => $row['class_name'] . ' ' . $row['section_name'],
                'student_roll_no' => $row['roll_no'],
                'exam_data' => []
            ];
        }
        $data[$title_id]['exam_data'][] = $row;
    }

    $html .= "<h3 style='clear:both; display:inline;'>Class: </h3>{$data[$exam_title_id]['student_class']}";
    $html .= "<h3 style='clear:both; display:inline;'>Name: </h3>{$data[$exam_title_id]['student_name']}";
    $html .= "<h3 style='clear:both; display:inline;'>Reg# </h3>{$data[$exam_title_id]['student_roll_no']}";
    // Start results table
    $html .= "<table style='margin-top: 5px' border='1'><thead>
        <tr><th class='text-center' colspan='3'><h2>{$data[$exam_title_id]['exam_title']}</h2></th></tr>
        <tr class='text-center'>
            <th>Subject</th>
            <th>Obtained</th>
            <th>Total</th>
        </tr>
    </thead><tbody>";

    // Loop through subjects to display marks
    $total_marks = 0;
    $obtained_total = 0;
    foreach ($data[$exam_title_id]['exam_data'] as $exam) {
        $subject = $exam['subject_name'];
        $obtained = $exam['obtained_marks'];
        $marks = $exam['total_marks'];
        $total_marks += $marks;
        $obtained_total += $obtained;

        $html .= "<tr class='text-center'>
            <td>$subject</td>
            <td>$obtained</td>
            <td>$marks</td>
        </tr>";
    }

    // Add final row for total
    $html .= "<tr class='text-center'>
        <td><strong>Result</strong></td>
        <td>$obtained_total</td>
        <td>$total_marks</td>
    </tr>";

    $html .= "</tbody></table>";


    // Add footer or signatures
    $html .= "<br><br><strong>Teacher:</strong> <u>___________________</u>
              &nbsp;&nbsp;&nbsp;&nbsp;<strong>Principal:</strong> <u>___________________</u>
              <br><br><strong>Dated:</strong> <u>___________________</u>";
              
    // fetching the admin id and adding the data
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> generated Exams Result of student <strong>{$data[$exam_title_id]['student_name']}</strong> !";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

    // Generate PDF
    $pdf_name = $data[$exam_title_id]['student_name'] . "-result" . ".pdf";
}
?>