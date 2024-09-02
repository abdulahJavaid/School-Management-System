<?php
if (isset($_POST['npaid_roll_no'])) {
    $get_roll = escape($_POST['npaid_roll_no']);

    $query = "SELECT * FROM school_profile_ ORDER BY id DESC LIMIT 1";
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
      position: relative;
      width: 21cm;  
      height: 29.7cm; 
      margin: 0 auto; 
      color: #001028;
      background: #FFFFFF; 
      font-family: Arial, sans-serif; 
      font-size: 12px; 
      font-family: Arial;
    }
    
    header {
      padding: 10px 0;
      margin-bottom: 30px;
    }
    
    #logo {
      text-align: center;
      margin-bottom: 10px;
    }
    
    #logo img {
      width: 90px;
    }
    
    h1 {
      border-top: 1px solid  #5D6975;
      border-bottom: 1px solid  #5D6975;
      color: #5D6975;
      font-size: 2.4em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 20px 0;
      background: url(uploads/pdf/dimension.png);
    }
    
    #project {
      float: left;
    }
    
    #project span {
      color: #5D6975;
      text-align: right;
      width: 52px;
      margin-right: 10px;
      display: inline-block;
      font-size: 0.8em;
    }
    
    #company {
      float: right;
      text-align: right;
    }
    
    #project div,
    #company div {
      white-space: nowrap;        
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }
    
    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }
    
    table th,
    table td {
      text-align: center;
    }
    
    table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;        
      font-weight: normal;
    }
    
    table .service,
    table .desc {
      text-align: left;
    }
    
    table td {
      padding: 20px;
      text-align: right;
    }
    
    table td.service,
    table td.desc {
      vertical-align: top;
    }
    
    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.2em;
    }
    
    table td.grand {
      border-top: 1px solid #5D6975;;
    }
    
    #notices .notice {
      color: #5D6975;
      font-size: 1.2em;
    }
    
    footer {
      color: #5D6975;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
    }
        </style>
      </head>
      <body>
        <header class='clearfix'>
          <div id='logo'>
            <img src='uploads/school-profile-uploads/";
    if (empty($image)) {
        $html .= "no-image.png";
    } else {
        $html .= "$image";
    }
    $html .= "'>
          </div>
          <h1>$name</h1>
          <div id='company' class='clearfix'>
            <div><span>Fee Report:</span> $year, $month</div>
            <div><span>Report Type:</span> Not-paid Fee Records</div>
            <div><span>Report Data:</span> Registration number { $get_roll }</div>
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

    // $query = "SELECT * FROM student_fee INNER JOIN student_profile ON ";
    // $query .= "student_fee.fk_student_id=student_profile.student_id ";
    // $query .= "WHERE fee_status='paid' AND year='$year' AND month='$month'";
    $query = "SELECT * FROM student_fee INNER JOIN student_profile ON ";
    $query .= "student_fee.fk_student_id=student_profile.student_id ";
    $query .= "WHERE roll_no='$get_roll' AND fee_status='unpaid' ORDER BY fee_id DESC";

    $result = query($query);
    while ($row = mysqli_fetch_assoc($result)) {
        $roll_no = $row['roll_no'];
        $s_name = $row['name'];
        $fee = $row['monthly_fee'];
        $paid = $row['monthly_fee'] - $row['pending_dues'];
        $dues = $row['pending_dues'];
        $html .= "<tr>
                <td class='service'>$roll_no</td>
                <td class='desc'>$s_name</td>
                <td class='unit'>Rs. $fee</td>
                <td class='qty'>Rs. 0</td>
              </tr>";
    }
    //   $html .= "<tr>
    //     <td colspan='4' class='grand total'>GRAND TOTAL</td>
    //     <td class='grand total'>$6,500.00</td>
    //   </tr>";
    $html .= "</tbody>
          </table>";
    $html .= "<br><br><br>
          <strong>Owner Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong>Accountant Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong>Editor Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
          <br><br>
          <strong>Dated:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
          ";


    // $html .= "<div id='notices'>
    //     <div>NOTICE:</div>
    //     <div class='notice'>A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    //   </div>";
    $html .= "</main>";
    // $html .= "<footer>
    //   Invoice was created on a computer and is valid without the signature and seal.
    // </footer>";
    $html .= "</body>
    </html>
    ";
}
?>