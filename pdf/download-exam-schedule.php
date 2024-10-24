<?php

// download the class timetable

if (isset($_POST['download_exam_schedule'])) {

    $sid = escape($_POST['section_id']);
    $class_name = escape($_POST['class_section']);
    $exam_title_id = escape($_POST['exam_title_id']);

    // Fetch school profile from the database
    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $result = mysqli_query($conn, $query);
    $school = mysqli_fetch_assoc($result);
    $school_name = $school['name'];
    $school_logo = $school['image'];
    // $class_name = "Class Name";

    // Generate HTML content
    $html = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Timetable</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                margin-top: 20px;
            }
            table th, table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }
            table th {
                background-color: #f2f2f2;
            }
            header {
                text-align: start;
                margin-bottom: 20px;
            }
            #logo img {
                width: 100px;
                height: auto;
                margin-left: 0%;
                float: left;
            }
            h1, h2 {
            }
        </style>
    </head>
    <body>
        <header>
            <div id='logo'>
                <img src='uploads/school-profile-uploads/$school_logo' alt='School Logo'>
            </div>
            <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$school_name</h1>
            <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$class_name - Date Sheet</h2>
        </header>
        <main>";

    // getting the exam schedule
    $query = "SELECT * FROM exam_schedule INNER JOIN exam_title ON ";
    $query .= "exam_schedule.fk_exam_title_id=exam_title.exam_title_id ";
    $query .= "INNER JOIN class_sections ON exam_schedule.fk_section_id=class_sections.section_id ";
    $query .= "INNER JOIN all_classes ON class_sections.fk_class_id=all_classes.class_id ";
    $query .= "INNER JOIN section_subjects ON ";
    $query .= "exam_schedule.fk_subject_id=section_subjects.subject_id ";
    $query .= "WHERE exam_schedule.fk_exam_title_id='$exam_title_id' ";
    $query .= "AND exam_schedule.fk_section_id='$sid' AND exam_schedule.fk_client_id='$client'";
    $result = query($query);

    // coupling the data for exam schedule view
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        if (!isset($data[$row['exam_title_id']])) {
            // $data[$row['exam_title_id']] = [];
            $data[$row['exam_title_id']] = [
                'class_name' => $row['class_name'],
                'section_name' => $row['section_name'],
                'exam_title' => $row['exam_title']
            ];
        }
        if (!isset($data[$row['exam_title_id']]['schedule'])) {
            $data[$row['exam_title_id']]['schedule'] = [];
        }
        $data[$row['exam_title_id']]['schedule'][] = $row;
    }

    // Loop over periods and days to fill the table rows
    foreach ($data as $key => $get) {
        $title = $get['exam_title'];
        $html .= "<table>
                    <thead>
                        <tr>
                        <th colspan='3'><h2>
                        $title
                        </h2></th>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                <tbody>";
        // $html .= "<tr>
        //             <td>$time</td>";
        foreach ($get['schedule'] as $schedule) {
            $exam_time = $schedule['exam_time'];
            $subject_name = $schedule['subject_name'];
            $exam_date = $schedule['exam_date'];
            $html .= "<tr><td>$exam_time</td><td>$subject_name</td><td>$exam_date</td></tr>";
        }
        // $html .= "</tr>";
    }

    $html .= "
                </tbody>
            </table>
        </main>
    </body>
    </html>
    ";

    // fetching the admin id and adding the data
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> generated date-sheet of class <strong>$class_name</strong> !";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

     // downloaded pdf name
    $pdf_name = $class_name . "-date-sheet.pdf";
}
