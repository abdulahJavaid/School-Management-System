<?php
// managing the subscription processes
// add the new school to the database
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Set the content type to JSON
header('Content-Type: application/json');

// getting the client id
$client = escape($_SESSION['client_id']);

// to request the student subscription
if (isset($_POST['request_sub'])) {
    $std_id = $_POST['request_sub']; // the student id

    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $get_school = query($query);
    $school = mysqli_fetch_assoc($get_school);
    $amount = $school['sub_amount'];
    $stake = $school['codsmine_stake'];

    $query = "INSERT INTO student_subscriptions(sub_status, sub_type, sub_amount, ";
    $query .= "codsmine_stake, fk_student_id, fk_client_id)";
    $query .= "VALUES('requested', 'school', '$amount', ";
    $query .= "'$stake' , '$std_id', '$client')";

    $set_subscription = query($query);

    $matches = [];
    if ($set_subscription) {

        $matches[] = ['msg' => "success"];
    } else {
        $matches[] = ['msg' => "failure"];
    }

    echo json_encode($matches);
}

// to approve the student subscription
if (isset($_POST['approve_sub'])) {
    $std_id = $_POST['approve_sub']; // the student id

    $expiry = date('Y-m-d', time() + (60 * 60 * 24 * 365));

    $query = "UPDATE student_subscriptions SET sub_status='on', sub_expiry='$expiry' ";
    $query .= "WHERE fk_student_id='$std_id' AND fk_client_id='$client'";

    $set_subscription = query($query);

    $matches = [];
    if ($set_subscription) {

        $matches[] = ['msg' => "success"];
    } else {
        $matches[] = ['msg' => "failure"];
    }

    echo json_encode($matches);
}

// school paid to codsmine
if (isset($_POST['school_paid'])) {
    $paid = $_POST['paid'];
    $paid_by = escape($_SESSION['school_name']);

    $sub_log = "$paid_by paid <strong>Rs.$paid</strong> to CodsMine.";

    $query = "INSERT INTO subscription_logs(sub_log, paid_amount, paid_by, fk_client_id) ";
    $query .= "VALUES('$sub_log', '$paid', '$paid_by', '$client')";
    $add_sub_log = query($query);
    if ($add_sub_log) {
        $last_id = mysqli_insert_id($conn);
        $query = "UPDATE student_subscriptions SET fk_sub_log_id='$last_id', `procedure`='processed' ";
        $query .= "WHERE sub_status='on' AND `procedure`='unprocessed' AND fk_sub_log_id='0' ";
        $query .= "AND fk_client_id='$client'";
        $update_subs = query($query);
        if ($update_subs) {
            redirect("../subs-school.php");
        }
    }
}
