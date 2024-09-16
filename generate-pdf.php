<?php
// the required documents
session_start();
ob_start();
require_once('./db_connection/configs.php');
require_once('./db_connection/connection.php');
require_once('./includes/functions.php');

if (!isset($_POST['generate']) && !isset($_POST['current_month']) && !isset($_POST['generate_name']) && !isset($_POST['generate_reg']) && !isset($_POST['dues_current_month']) && !isset($_POST['dues_name']) && !isset($_POST['dues_reg']) && !isset($_POST['notpaid_current_month']) && !isset($_POST['notpaid_name']) && !isset($_POST['notpaid_reg']) && !isset($_POST['download_school_vouchers']) && !isset($_POST['download_class_vouchers']) && !isset($_POST['download_student_voucher']) && !isset($_POST['generate_paid_salary'])) {
    redirect("./");
}

// getting the session id
$client = escape($_SESSION['client_id']);

// if ( !isset($_POST['dues_name']) && !isset($_POST['dues_reg'])) {
//     redirect("./");
// }

// generating the pdf

// requiring the autoload file for dompdf
require __DIR__ . "/vendor/autoload.php";

// refactoring the code
include "pdf/fee-record-current-month.php";
include "pdf/fee-record-by-name.php";
include "pdf/fee-record-by-rollno.php";
include "pdf/dues-current-month.php";
include "pdf/dues-by-name.php";
include "pdf/dues-by-rollno.php";
include "pdf/notpaid-current-month.php";
include "pdf/notpaid-by-name.php";
include "pdf/notpaid-by-rollno.php";
include "pdf/expense-receiving.php";
include "pdf/vouchers-school.php";
include "pdf/vouchers-class.php";
include "pdf/vouchers-student.php";
include "pdf/salaries-paid.php";


// using the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// creating the new object for Dompdf
$options = new Options;
$options->setChroot(__DIR__);
$pdf = new Dompdf($options);

// paper settings
$pdf->setPaper("A4", "portrait");

// the code

// $html = file_get_contents("pdf.html");
$pdf->loadHtml($html);
// $pdf->loadHtmlFile("login-old.php");

// loading pdf
$pdf->render();
// $pdf->addInfo("Title", "The expense sheet");
$pdf->stream("expense.pdf", ["Attachment" => 0]);
?>