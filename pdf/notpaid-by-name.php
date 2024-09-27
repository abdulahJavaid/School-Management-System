<?php
if (isset($_POST['npaid_name'])) {
  $get_name = escape($_POST['npaid_name']);
  // fetching the admin id and adding the data
  $admin_name = escape($_SESSION['login_name']);
  $log = "Admin <strong>$admin_name</strong> generated unpaid fee records of students with name {<strong>$get_name</strong>} !";
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
  $month = date('F');
  $year = date('Y');
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
            <div><span>Generated On:</span> $year, $month</div>
            <div><span>Report Type:</span> Not-paid Fee Records</div>
            <div><span>Report Data:</span> Names including word { $get_name }</div>
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
                <th><h3>Amount Paid</h3></th>
              </tr>
            </thead>
            <tbody>";
  $query = "SELECT * FROM student_fee INNER JOIN student_profile ON ";
  $query .= "student_fee.fk_student_id=student_profile.student_id ";
  $query .= "WHERE name LIKE '%$get_name%' AND student_status='1' AND (fee_status='unpaid' OR fee_status='rejected') AND student_fee.fk_client_id='$client' ORDER BY fee_id DESC";

  $result = query($query);
  while ($row = mysqli_fetch_assoc($result)) {
    $roll_no = $row['roll_no'];
    $s_name = $row['name'];
    $fee = $row['monthly_fee'];
    $paid = $row['monthly_fee'];
    $dues = $row['pending_dues'];
    $html .= "<tr>
                <td class='service'>$roll_no</td>
                <td class='desc'>$s_name</td>
                <td class='unit'>Rs. $fee</td>
                <td class='qty'>Rs. 0</td>
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
?>
