<?php
if (isset($_POST['salary_p_month'])) {

    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";  
    $result = mysqli_query($conn, $query);
    $ro = mysqli_fetch_assoc($result);

    $s_name = $ro['name'];
    $address = $ro['address'];
    $contact = $ro['contact'];
    $email = $ro['email'];

    // School details and header
    $html = "<div style='clear:float;'><img style='float:left;' src='images/savy.png' height='155px' width='155px' alt='school-image'>";
    $html .= "<h1>$s_name</h1><h5>$address</h5><h5>$contact</h5><h5>$email</h5></div><br><h2 style='clear:both;'>Paid Salary Records</h2>";

    // Styles
    $html .= "
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            margin-top: 0px;
        }
        .table-container {
            width: 100%;
            margin: 0 auto;
        }
        table {
            width: 100%; 
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            white-space: normal;
        }
        th {
            background-color: #f0f0f0;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            table {
                width: 100%;
                font-size: 12px;
            }
        }
    </style>";

    // Table header
    $html .= "<table border='1'>
    <thead>
    <tr>
    <th>Name</th>
    <th>Designation</th>
    <th>Salary</th>
    <th>Paid Salary</th>
    <th>Bonuses</th>
    <th>Total Paid</th>
    <th>Month</th>
    </tr>
    </thead>
    <tbody>";

    // Process salaries
    $date = $_POST['salary_p_month'] . '-01';
    $month = date('F', strtotime($date));
    $year = date('Y', strtotime($date));

    // fetching the admin id and adding the data
    $id = escape($_SESSION['login_id']);
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> generated paid salary records for <strong>$month, $year</strong> !";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);


    // getting the employee salary records for the selected month
    $query = "SELECT * FROM employee_salary WHERE month='$month' AND year='$year' AND salary_status='paid' AND fk_client_id='$client'";
    $result = mysqli_query($conn, $query);

    $totals = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['fk_staff_id'] == '0'){
            $tch_id = $row['fk_teacher_id'];
            $query = "SELECT * FROM teacher_profile WHERE teacher_id='$tch_id' AND teacher_status='1' AND fk_client_id='$client'";
            $g_result = mysqli_query($conn, $query);
            $rows = mysqli_fetch_assoc($g_result);
        } else {
            $stf_id = $row['fk_staff_id'];
            $query = "SELECT * FROM staff_profile WHERE staff_id='$stf_id' AND staff_status='1' AND fk_client_id='$client'";
            $g_result = mysqli_query($conn, $query);
            $rows = mysqli_fetch_assoc($g_result);
        }

        $name = $rows['name'];
        $designation = ($row['fk_staff_id'] == 0) ? 'Teacher' : $rows['staff_designation'];
        $sal_month = $month . ", " . $year;
        $salary = $row['salary_amount'];
        $paid = $row['paid_salary'];

        $sal_id = $row['salary_id'];
        $query = "SELECT * FROM salary_bonus WHERE fk_salary_id='$sal_id' AND fk_client_id='$client'";
        $g_bonus = mysqli_query($conn, $query);
        
        $bonuses = '';  // Reset bonuses for each row
        $t_bonus = 0;
        if (mysqli_num_rows($g_bonus) != 0) {
            while ($rowss = mysqli_fetch_assoc($g_bonus)) {
                $bonuses .= '- ' . $rowss['bonus_title'] . '<br>Rs.' . $rowss['bonus_amount'] . '<br>';
                $t_bonus += (int) $rowss['bonus_amount'];
            }
        } else {
            $bonuses = '---';
        }

        // Calculate paid salary excluding bonuses
        $p_salary = (int) $paid - (int) $t_bonus;

        // Append the row to the table
        $html .= "<tr>
        <td>$name</td>
        <td>$designation</td>
        <td>Rs.$salary</td>
        <td>Rs.$p_salary</td>
        <td>$bonuses</td>
        <td>Rs.$paid</td>
        <td>$sal_month</td>
        </tr>";
        $totals += (int) $paid;
    }

    // Closing table
  $html .= "</tbody>
  </table>
</div>
<br><br><br>
<strong>Owner:</strong> <u>__________________________</u>
&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Accountant:</strong> <u>__________________________</u>
<br><br>
<strong>Dated:</strong> <u>_________________</u>
</main>
</body>
</html>
";
}