<?php

    // 1. Teacher log/activity for marking the class attendance is missing
    // 2. passwords encryption on all site
    // 3. image uploads on all site
    // 4. hover for buttons
    // 5. define access level for teacher & admins(accountant, profiler, scheduler)
    // 6. students parents are missing
    // 7. Required missing from all form fields
?>


<?php 
session_start();
ob_start();
require_once('db_connection/configs.php');
require_once('db_connection/connection.php');
require_once('includes/functions.php');

$date = date('Y-m-d', time());

$query = "SELECT * FROM expense_receiving WHERE date='$date'";
$result = mysqli_query($conn, $query);
$exp = 0;
$rec = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $exp += (int) $row['expense'];
    $rec += (int) $row['receiving'];
}
echo $exp;
echo ' '.$rec;




?>