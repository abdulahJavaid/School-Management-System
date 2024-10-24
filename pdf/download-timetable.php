<?php

// download the class timetable

if (isset($_POST['download_timetable'])) {

    $sid = escape($_POST['section_id']);
    $class_name = escape($_POST['class_section']);

    // Fetch school profile from the database
    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $result = mysqli_query($conn, $query);
    $school = mysqli_fetch_assoc($result);
    $school_name = $school['name'];
    $school_logo = $school['image'];
    // $class_name = "Class Name";

    // Fetch timetable from the database
    $query = "SELECT * FROM timetable WHERE fk_section_id='$sid' AND fk_client_id='$client'";
    $result = query($query);
    $timetable = [];
    while ($row3 = mysqli_fetch_assoc($result)) {
        $day = $row3['day'];
        $timetable[$day] = $row3;  // Store each day's name
    }

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
            <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$class_name - Timetable</h2>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                </thead>
                <tbody>";

    // Fetch periods and fill the table
    $query = "SELECT * FROM periods WHERE fk_section_id='$sid' AND fk_client_id='$client'";
    $periods = query($query);
    $period_data = [];
    while ($ro = mysqli_fetch_assoc($periods)) {
        $time = $ro['time'];
        if (!isset($period_data[$time])) {
            $period_data[$time] = [];
        }
        $period_data[$time][] = ($ro['period_name'] == 'break') ? 'Break' : $ro['period_name'] . ' - ' . $ro['teacher_name'];
    }

    // Loop over periods and days to fill the table rows
    foreach ($period_data as $time => $schedule) {
        $html .= "<tr>
                    <td>$time</td>";
        foreach ($schedule as $day_schedule) {
            $html .= "<td>$day_schedule</td>";
        }
        $html .= "</tr>";
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
    $log = "Admin <strong>$admin_name</strong> generated timetable of class <strong>$class_name</strong> !";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

    // downloaded pdf name
    $pdf_name = $class_name . "-timetable.pdf";
}
