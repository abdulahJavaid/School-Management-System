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


$html = "<center><h3>The expense sheet</h3></center>";
$html .= "<table style='border: 1px solid black;'>
<thead>
<tr>
<th>One</th>
<th>Two</th>
</tr>
</thead>
<tbody>
<tr>
<td>one</td>
<td>two</td>
</tr>
</tbody>
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
