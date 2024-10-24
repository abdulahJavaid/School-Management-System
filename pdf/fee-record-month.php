<?php
// paid fee for the current month

if (isset($_POST['month'])) {

    $date = $_POST['month'];
    $timestamp = strtotime($date);
    $year = date('Y', $timestamp);
    $month = date('F', $timestamp);
    // fetching the admin id and adding the data
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> generated paid fee records of <strong>$month, $year</strong> !";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;
    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $address = $row['address'];
    $contact = $row['contact'];
    $email = $row['email'];
    $image = $row['image'];
    $current_month = date('F');
    $current_year = date('Y');
    $html = "
    <!DOCTYPE html>
    <html lang='en'>
      <head>
        <meta charset='utf-8'>
        <title>Example 1</title>
        <style>

          /* Clearfix to fix floating elements */
          .clearfix:after {
            content: '';
            display: table;
            clear: both;
          }
          
          a {
            color: #5D6975;
            text-decoration: underline;
          }
          
          body {
            width: 100%;
            margin: 0 auto;
            color: #001028;
            font-family: Arial, sans-serif;
            font-size: 12px;
            background: #FFFFFF;
          }

          header {
            padding: 10px 0;
            margin-bottom: 20px;
            text-align: center;
          }

          #logo img {
            width: 80px;
          }

          h1 {
            color: #5D6975;
            font-size: 2.2em;
            text-align: center;
            margin-bottom: 15px;
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            padding: 5px 0;
            background: url(uploads/pdf/dimension.png);
          }

          #project, #company {
            text-align: left;
            margin-bottom: 20px;
          }

          #company {
            text-align: right;
            float: right;
          }

          #project div {
            margin-bottom: 5px;
          }

          table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
          }

          table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
          }

          table th {
            background: #F5F5F5;
            text-align: center;
          }

          table td {
            text-align: center;
          }

          .table-container {
            width: 100%;
          }

          /* Print styling */
          @media print {
            body {
              width: 100%;
              margin: 0;
              padding: 0;
            }
            header, footer {
              page-break-before: always;
            }
            table {
              font-size: 11px;
            }
          }

        </style>
      </head>
      <body>
        <header class='clearfix'>
          <h1>$name</h1>
          <div id='company' class='clearfix'>
            <div><span><strong>Generated On:</strong></span> $current_year, $current_month</div>
            <div><span><strong>Report Type:</strong></span> Paid Fee Records</div>
            <div><span><strong>Report Data:</strong></span> $year, $month records</div>
          </div>
          <div id='project'>
            <div>$contact</div>
            <div>$email</div>
            <div>$address</div>
          </div>
        </header>
        <main>
          <table>
            <thead>
              <tr>
                <th class='service'><h3>Reg no#</h3></th>
                <th class='desc'><h3>Name</h3></th>
                <th><h3>Monthly Fee</h3></th>
                <th><h3>Funds</h3></th>
                <th><h3>Total Fee</h3></th>
                <th><h3>Amount Paid</h3></th>
                <th><h3>Dues</h3></th>
              </tr>
            </thead>
            <tbody>";

    $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
    $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
    $query .= "INNER JOIN student_profile ON ";
    $query .= "student_fee.fk_student_id=student_profile.student_id ";
    $query .= "WHERE fee_status='paid' AND student_status='1' AND year='$year' AND month='$month' ";
    $query .= "AND student_fee.fk_client_id='$client'";

    // looping to get the funds record
    $result = query($query);
    $funds = [];
    $main_data = [];
    while ($rows = mysqli_fetch_assoc($result)) {
        $main_id = $rows['fee_id'];
        if (!empty($rows['fk_fee_id'])) {
            if (!isset($funds[$main_id])) {
                $funds[$main_id] = [
                    'funds' => []
                ];
            }
            $funds[$main_id]['funds'][] = '<strong>' . $rows['fund_title'] . '</strong><br>' . $rows['fund_amount'] . '<br>';
        }
        if (!isset($main_data[$main_id])) {
            $main_data[$main_id] = $rows;
        }
    }
    // showing the records in the main table
    foreach ($main_data as $row) {
        $current_id = $row['fee_id'];
        $roll_no = $row['roll_no'];
        $s_name = $row['name'];
        $fee = $row['monthly_fee'];
        $total_fee = $row['total_fee'];
        $paid = $row['total_fee'];
        $dues = $row['pending_dues'];
        $html .= "<tr>
                <td class='service'>$roll_no</td>
                <td class='desc'>$s_name</td>
                <td class='unit'>Rs.$fee</td>
                <td class='unit'>";
        if (isset($funds[$current_id])) {
            foreach ($funds[$current_id]['funds'] as $get) {
                $html .= "$get";
            }
        } else {
            $html .= "---";
        }
        $html .= "</td>
                <td class='unit'>Rs.$total_fee</td>
                <td class='qty'>Rs.$paid</td>
                <td class='total'>Rs.$dues</td>
              </tr>";
    }
    $html .= "</tbody>
            </table>
          </div>
          <br><br><br>
          <strong>Owner:</strong> <u>___________________</u>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <strong>Accountant:</strong> <u>___________________</u>
          <br><br><br>
          <strong>Dated:</strong> <u>___________________</u>
        </main>
      </body>
    </html>
  ";
  
  // downloaded pdf name
  $pdf_name = "paid-fee-record-of-" . $year . '-' . $month . ".pdf";
}
// the logo code
//   <div id='logo'>
//   <img src='uploads/school-profile-uploads/";
//   if(empty($image)){
//       $html .= "no-image.png";
//   }else {
//       $html .= "$image";
//   }
//   $html .= "' width='155px' height='100px' style='border-radius: 5%;'>
// </div>
