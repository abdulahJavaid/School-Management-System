<?php
// the required documents
session_start();
ob_start();
require_once('./db_connection/configs.php');
require_once('./db_connection/connection.php');
require_once('./includes/functions.php');

if (!isset($_POST['generate']) && !isset($_GET['generate'])) {
    redirect("./");
}



// generating the pdf

// requiring the autoload file for dompdf
require __DIR__ . "/vendor/autoload.php";

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
        <img src='uploads/school-profile-uploads/school.png'>
      </div>
      <h1>INVOICE 3-2-1</h1>
      <div id='company' class='clearfix'>
        <div>Company Name</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href='mailto:company@example.com'>company@example.com</a></div>
      </div>
      <div id='project'>
        <div><span>PROJECT</span> Website development</div>
        <div><span>CLIENT</span> John Doe</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL</span> <a href='mailto:john@example.com'>john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
        <div><span>DUE DATE</span> September 17, 2015</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class='service'>SERVICES</th>
            <th class='desc'>DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class='service'>Design</td>
            <td class='desc'>Creating a recognizable design solution based on the company's existing visual identity</td>
            <td class='unit'>$40.00</td>
            <td class='qty'>26</td>
            <td class='total'>$1,040.00</td>
          </tr>
          <tr>
            <td class='service'>Development</td>
            <td class='desc'>Developing a Content Management System-based Website</td>
            <td class='unit'>$40.00</td>
            <td class='qty'>80</td>
            <td class='total'>$3,200.00</td>
          </tr>
          <tr>
            <td class='service'>SEO</td>
            <td class='desc'>Optimize the site for search engines (SEO)</td>
            <td class='unit'>$40.00</td>
            <td class='qty'>20</td>
            <td class='total'>$800.00</td>
          </tr>
          <tr>
            <td class='service'>Training</td>
            <td class='desc'>Initial training sessions for staff responsible for uploading web content</td>
            <td class='unit'>$40.00</td>
            <td class='qty'>4</td>
            <td class='total'>$160.00</td>
          </tr>
          <tr>
            <td colspan='4'>SUBTOTAL</td>
            <td class='total'>$5,200.00</td>
          </tr>
          <tr>
            <td colspan='4'>TAX 25%</td>
            <td class='total'>$1,300.00</td>
          </tr>
          <tr>
            <td colspan='4' class='grand total'>GRAND TOTAL</td>
            <td class='grand total'>$6,500.00</td>
          </tr>
        </tbody>
      </table>
      <div id='notices'>
        <div>NOTICE:</div>
        <div class='notice'>A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
";

// $query = "SELECT * FROM school_profile_ ORDER BY id DESC LIMIT 1";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);

// $name = $row['name'];
// $address = $row['address'];
// $contact = $row['contact'];
// $email = $row['email'];

// // <tr>
// // <th colspan='4' style='min-width:auto;'><h3>Total Expenses</h3></th>
// // </tr>

// $html = "<div style='clear:float;'><img style='float:left;' src='images/savy.png' height='155px' width='155px' alt='school-image'>";
// $html .= "<h1>$name</h1><h5>$address</h5><h5>$contact</h5><h5>$email</h5></div><br><h2 style='clear:both;'>Expense and Receiving</h2>";
// $html .= "<table border='1' style='border-collapse:collapse'>
// <thead>
// <tr>
// <th style='min-width:200px;'>Date</th>
// <th style='min-width:200px;'>Comment</th>
// <th style='min-width:200px;'>Expense</th>
// <th style='min-width:200px;'>Receiving</th>
// </tr>
// </thead>
// <tbody>";
// if (empty($_POST['two']) || $_POST['one'] == $_POST['two']) {
//     $date = $_POST['one'];
//     $query = "SELECT * FROM expense_receiving WHERE date='$date'";
//     $result = mysqli_query($conn, $query);

//     $exp = 0;
//     $rec = 0;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $exp += (int) $row['expense'];
//         $rec += (int) $row['receiving'];
//         $comment = $row['comment'];
//         $expense = $row['expense'];
//         $date = $row['date'];
//         $receiving = $row['receiving'];
//         $html .= "<tr>
// <td>$date</td>
// <td>$comment</td>";
//         if ($expense == 0) {
//             $html .= "<td>---</td>";
//         } else {
//             $html .= "<td>Rs. $expense</td>";
//         }
//         if ($receiving == 0) {
//             $html .= "<td>---</td>";
//         } else {
//             $html .= "<td>Rs. $receiving</td>";
//         }
//         $html .= "</tr>";
//     }
// } else {
//     $date = $_POST['one'];
//     $date1 = $_POST['two'];
//     $query = "SELECT * FROM expense_receiving WHERE date BETWEEN '$date' AND '$date1'";
//     $result = mysqli_query($conn, $query);

//     $exp = 0;
//     $rec = 0;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $exp += (int) $row['expense'];
//         $rec += (int) $row['receiving'];
//         $comment = $row['comment'];
//         $expense = $row['expense'];
//         $date = $row['date'];
//         $receiving = $row['receiving'];
//         $html .= "<tr>
//     <td>$date</td>
//     <td>$comment</td>";
//         if ($expense == 0) {
//             $html .= "<td>---</td>";
//         } else {
//             $html .= "<td>Rs. $expense</td>";
//         }
//         if ($receiving == 0) {
//             $html .= "<td>---</td>";
//         } else {
//             $html .= "<td>Rs. $receiving</td>";
//         }
//         $html .= "</tr>";
//     }
// }
// $sum = $rec - $exp;
// $html .= "
// <tr>
// <td colspan='2'>---</td>
// <td>Rs. $exp</td>
// <td>Rs. $rec</td>
// </tr>
// <tr>
// <td colspan='2'>---</td>
// <td colspan='2'><strong>Total: </strong>Rs. $sum</td>
// </tr>
// </tbody>
// </table>
// <br><br><br>
// <strong>Owner Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
// &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
// <strong>Accountant Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
// &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
// <strong>Editor Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
// <br><br>
// <strong>Dated:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
// ";

// <td><img src='./uploads/expense-uploads/$img' width='50px' height='50px' alt=''></td>

// using the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// creating the new object for Dompdf
$options = new Options;
$options->setChroot(__DIR__);
$pdf = new Dompdf($options);

// paper settings
$pdf->setPaper("A4", "landscape");

// the code

// $html = file_get_contents("pdf.html");
$pdf->loadHtml($html);
// $pdf->loadHtmlFile("login-old.php");

// loading pdf
$pdf->render();
// $pdf->addInfo("Title", "The expense sheet");
$pdf->stream("expense.pdf", ["Attachment" => 0]);
