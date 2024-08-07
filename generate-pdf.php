<?php
// the required documents
session_start();
ob_start();
require_once('./db_connection/configs.php');
require_once('./db_connection/connection.php');
require_once('./includes/functions.php');



// generating the pdf

// requiring the autoload file for dompdf
require __DIR__ . "/vendor/autoload.php";

$query = "SELECT * FROM school_profile_ ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$address = $row['address'];
$contact = $row['contact'];
$email = $row['email'];


$html = "<div style='clear:float;'><img style='float:left;' src='images/savy.png' height='155px' width='155px' alt='school-image'>";
$html .= "<h1>$name</h1><h5>$address</h5><h5>$contact</h5><h5>$email</h5></div><br><h2 style='clear:both;'>Total expenditure</h2>";
$html .= "<table border='1' style='border-collapse:collapse'>
<thead>
<tr>
<th colspan='3' style='min-width:auto;'>Total Expenses</th>
</tr>
<tr>
<th style='min-width:200px;'>Description</th>
<th style='min-width:200px;'>Cost</th>
<th style='min-width:200px;'>Date</th>
</tr>
</thead>
<tbody>";
$query = "SELECT * FROM add_exp WHERE date='2024-08-06'";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)){
    $comment = $row['comment'];
    $cost = $row['cost'];
    $date = $row['date'];
$html .= "<tr>
<td>$comment</td>
<td>Rs. $cost</td>
<td>$date</td>
</tr>";
}
$html .= "</tbody>
</table>";

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
