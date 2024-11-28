<?php
// dues of the the student

if (isset($_POST['section_for_dues_voucher'])) {
    $section = escape($_POST['section_for_dues_voucher']);

    // // if the registration number is invalid, redirect
    // $query = "SELECT * FROM student_profile WHERE roll_no='$roll_no' AND fk_client_id='$client'";
    // $data = query($query);
    // if (mysqli_num_rows($data) == 0) {
    //     redirect("./fee-vouchers.php?ms=1");
    // }

    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $address = $row['address'];
    $contact = $row['contact'];
    $email = $row['email'];
    $image = $row['image'];
    $month = date('F');
    $year = date('Y');

    $query = "SELECT * FROM student_fee ";
    $query .= "INNER JOIN student_profile ON ";
    $query .= "student_fee.fk_student_id=student_profile.student_id INNER JOIN ";
    $query .= "student_class ON student_profile.student_id=student_class.fk_student_id INNER JOIN ";
    $query .= "class_sections ON student_class.fk_section_id=class_sections.section_id INNER JOIN ";
    $query .= "all_classes ON class_sections.fk_class_id=all_classes.class_id ";
    $query .= "WHERE fee_status LIKE '%due%' AND section_id='$section' ";
    $query .= "AND student_class.status='1' ";
    $query .= "AND student_status='1' AND student_fee.fk_client_id='$client' ORDER BY student_id";

    // looping to get the funds record
    $the_class = '';
    $the_section = '';
    $result = query($query);
    $student = [];
    $main_data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        if ($the_class == '' || $the_section == '') {
            $the_class = $row['class_name'];
            $the_section = $row['section_name'];
        }

        $main_id = $row['fee_id'];
        $student_id = $row['student_id'];

        if (!isset($student[$student_id])) {
            $student[$student_id] = [
                'student' => $row,
                'dues' => [],
            ];
        }
        $student[$student_id]['dues'][] = $row;
    }

    $html = "
  <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Fee Voucher</title>
    <style>
body {
    font-family: Arial, sans-serif;
    color: #000;
    margin: 0;
    padding: 0;
}

.vouchers {
    display: table;
    width: 100%;
    margin: 0 auto;
    border-spacing: 10px; /* Space between the two vouchers */
}

.voucher-container {
    display: table-cell;
    width: 48%; /* Each voucher takes up nearly half the page */
    padding: 20px;
    border: 1px solid #000;
    box-sizing: border-box;
    vertical-align: top;
}

.school-name {
    font-size: 1.2em;
    text-align: left;
    margin: 0;
    padding: 5px 0;
}

.voucher-title {
    font-size: 1.1em;
    text-align: left;
    margin: 0;
    padding: 5px 0;
}

.voucher-details, .payment-info, .footer {
    margin: 15px 0;
    font-size: 0.9em;
}

.fee-table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
}

.fee-table th, .fee-table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
    font-size: 0.9em;
}

.fee-table th {
    background-color: #f0f0f0;
}

.footer {
    text-align: center;
    font-size: 0.8em;
}

.voucher-header {
    display: flex;
    justify-content: space-between;
}

.voucher-type {
    font-weight: bold;
    font-size: 0.9em;
}

@media print {
    .vouchers {
        page-break-after: always;
    }
    
    .voucher-container {
        height: 100%; /* Ensure full height for each voucher container */
        page-break-inside: avoid;
    }
}

    </style>
</head>
<body>";
    // showing the records in the main table
    foreach ($student as $key => $gets) {
        $rows = $gets['student'];
        $student_name = $rows['name'];
        $roll_no = $rows['roll_no'];
        $class = $rows['class_name'];
        $section = $rows['section_name'];

        $html .= "<div class='vouchers'>
        <div class='voucher-container'>
            <div class='voucher-header'>
            <center><img src='./uploads/school-profile-uploads/$image' width='70px' height='70px'/></center>
            <span class='voucher-type'>Student Copy</span><br>
                <h3 class='school-name'>$name</h3>
            </div>
            <h2 class='voucher-title'>Dues Voucher</h2>
            
            <div class='voucher-details'>
                <p><strong>Student Name:</strong> $student_name</p>
                <p><strong>Reg. Number:</strong> $roll_no</p>
                <p><strong>Class:</strong> $class $section</p>
                <p><strong>Month:</strong> $year $month</p>
            </div>
            
            <table class='fee-table'>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>";
        $total_to_pay = 0;
        foreach ($gets['dues'] as $row) {
            $due_month = $row['month'];
            $due_year = $row['year'];
            $remaining_dues = $row['pending_dues'];
            $html .= "<tr>
                        <td>$due_month, $due_year</td>
                        <td>Rs.$remaining_dues</td>
                    </tr>";
            $total_to_pay += $remaining_dues;
        }

        $html .= "<tr>
                        <td><strong>Total Dues</strong></td>
                        <td>Rs.$total_to_pay</td>
                    </tr>
                    </tbody>
            </table>
            
            <div class='payment-info'>";
        // <p><strong>Last Date:</strong> 10 days</p>
        $html .= "<p><strong>Payment Method:</strong> Online Transfer/Cash</p>
            </div>
            
            <div class='footer'>
                <p><strong>Note:</strong> Please ensure payment is made by the due date to avoid any inconvenience.</p>
            </div>
        </div>

        <div class='voucher-container'>
            <div class='voucher-header'>
            <center><img src='./uploads/school-profile-uploads/$image' width='70px' height='70px'/></center>
            <span class='voucher-type'>School Copy</span><br>
                <h3 class='school-name'>$name</h3>
            </div>
            <h2 class='voucher-title'>Dues Voucher</h2>
            
            <div class='voucher-details'>
                <p><strong>Student Name:</strong> $student_name</p>
                <p><strong>Reg. Number:</strong> $roll_no</p>
                <p><strong>Class:</strong> $class $section</p>
                <p><strong>Month:</strong> $year $month</p>
            </div>
            
            <table class='fee-table'>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>";
        $total_to_pay = 0;
        foreach ($gets['dues'] as $row) {
            $due_month = $row['month'];
            $due_year = $row['year'];
            $remaining_dues = $row['pending_dues'];
            $html .= "<tr>
                        <td>$due_month, $due_year</td>
                        <td>Rs.$remaining_dues</td>
                    </tr>";
            $total_to_pay += $remaining_dues;
        }
        $html .= "<tr>
                        <td><strong>Total Dues</strong></td>
                        <td>Rs.$total_to_pay</td>
                    </tr>
                    </tbody>
            </table>
            
            <div class='payment-info'>";
        // <p><strong>Last Date:</strong> 10 days</p>
        $html .= "<p><strong>Payment Method:</strong> Online Transfer/Cash</p>
            </div>
            
            <div class='footer'>
                <p><strong>Note:</strong> Please ensure payment is made by the due date to avoid any inconvenience.</p>
            </div>
        </div>
    </div>";
    }
    $html .= "</body>
</html>
  ";

    // fetching the admin id and adding the data
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> generated dues vouchers of class <strong>$the_class $the_section</strong>!";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

    // downloaded pdf name
    $pdf_name = "dues-vouchers-class-" . $the_class . '-' . $the_section . ".pdf";
}
