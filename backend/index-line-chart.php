<?php
// Start session and include necessary files
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Fetch filter from GET, default to 'Today'
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'today';

// Prepare query based on the filter
if ($filter == 'Today') {
    $query1 = "SELECT expense, date FROM expense_receiving WHERE receiving = 0 AND date >= CURDATE()";
    $query2 = "SELECT receiving, date FROM expense_receiving WHERE expense = 0 AND date >= CURDATE()";
    $query3 = "SELECT pending_dues, payment_date FROM student_fee WHERE pending_dues != 0 AND payment_date = CURDATE()";
} elseif ($filter == 'month') {
    $query1 = "SELECT expense, date FROM expense_receiving WHERE receiving = 0 AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
    $query2 = "SELECT receiving, date FROM expense_receiving WHERE expense = 0 AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
    $query3 = "SELECT pending_dues, payment_date FROM student_fee WHERE pending_dues != 0 AND MONTH(payment_date) = MONTH(CURDATE())";
} else {
    $query1 = "SELECT expense, date FROM expense_receiving WHERE receiving = 0 AND YEAR(date) = YEAR(CURDATE())";
    $query2 = "SELECT receiving, date FROM expense_receiving WHERE expense = 0 AND YEAR(date) = YEAR(CURDATE())";
    $query3 = "SELECT pending_dues, payment_date FROM student_fee WHERE pending_dues != 0 AND YEAR(payment_date) = YEAR(CURDATE())";
}

// Execute queries
$result1 = query($query1);
$result2 = query($query2);
$result3 = query($query3);

$data = ['expense' => [], 'receivings' => [], 'dues' => []];
$categories = [];

// Fetch and organize data for chart
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $data['expense'][] = $row['expense'];
        $categories[] = $row['date'];
    }
}
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $data['receivings'][] = $row['receiving'];
        $categories[] = $row['date'];
    }
}
if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $data['dues'][] = $row['pending_dues'];
        $categories[] = $row['payment_date'];
    }
}

// Return JSON response
echo json_encode(['data' => $data, 'categories' => array_unique($categories)]);
?>
