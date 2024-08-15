<?php
// the required documents
session_start();
ob_start();
require_once('./db_connection/configs.php');
require_once('./db_connection/connection.php');
require_once('./includes/functions.php');

if (!isset($_POST['generate']) && !isset($_POST['current_month']) && !isset($_POST['generate_name'])) {
    redirect("./");
}



// generating the pdf

// requiring the autoload file for dompdf
require __DIR__ . "/vendor/autoload.php";

include "pdf/fee-current-month.php";
include "pdf/fee-record-name.php";



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
