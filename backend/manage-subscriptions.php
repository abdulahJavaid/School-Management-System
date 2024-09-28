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

    // getting the student name
    $query = "SELECT name FROM student_profile WHERE student_id='$std_id' AND fk_client_id='$client'";
    $get_student = query($query);
    $student_name = mysqli_fetch_assoc($get_student);
    $student_name = $student_name['name'];

    // getting the school data
    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $get_school = query($query);
    $school = mysqli_fetch_assoc($get_school);
    $amount = $school['sub_amount'];
    $stake = $school['codsmine_stake'];

    // checking if the subscription is requested
    $query = "SELECT * FROM student_subscriptions WHERE fk_student_id='$std_id' ";
    $query .= "AND fk_client_id='$client' AND sub_status='requested'";
    $check_requested = query($query);

    $matches = [];
    if (mysqli_num_rows($check_requested) > 0) {
        $matches[] = ['msg' => "failure"];
    } else {
        // requesting subscription
        $query = "INSERT INTO student_subscriptions(sub_status, sub_type, sub_amount, ";
        $query .= "codsmine_stake, fk_student_id, fk_client_id)";
        $query .= "VALUES('requested', 'school', '$amount', ";
        $query .= "'$stake' , '$std_id', '$client')";
        $set_subscription = query($query);


        if ($set_subscription) {
            // fetching the admin id and adding the data
            $id = escape($_SESSION['login_id']);
            $admin_name = escape($_SESSION['login_name']);
            $log = "Admin <strong>$admin_name</strong> requested subscription of student <strong>$student_name</strong> !";
            $times = date('d/m/Y h:i a', time());
            $times = (string) $times;
            // adding activity into the logs
            $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
            $pass_query2 = mysqli_query($conn, $query);

            $matches[] = ['msg' => "success"];
        } else {
            $matches[] = ['msg' => "failure"];
        }
    }

    echo json_encode($matches);
}

// to approve the student subscription
if (isset($_POST['approve_sub'])) {
    $std_id = $_POST['approve_sub']; // the student id

    // getting the student name
    $query = "SELECT name FROM student_profile WHERE student_id='$std_id' AND fk_client_id='$client'";
    $get_student = query($query);
    $student_name = mysqli_fetch_assoc($get_student);
    $student_name = $student_name['name'];

    // approving subscription
    $expiry = date('Y-m-d', time() + (60 * 60 * 24 * 365));
    $query = "UPDATE student_subscriptions SET sub_status='on', sub_expiry='$expiry' ";
    $query .= "WHERE fk_student_id='$std_id' AND fk_client_id='$client'";
    $set_subscription = query($query);

    $matches = [];
    if ($set_subscription) {
        // fetching the admin id and adding the data
        $id = escape($_SESSION['login_id']);
        $admin_name = escape($_SESSION['login_name']);
        $log = "<strong>$admin_name</strong> from CodsMine activated subscription of student <strong>$student_name</strong> !";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

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

    // subscription log
    $sub_log = "$paid_by paid <strong>Rs.$paid</strong> to CodsMine.";
    $query = "INSERT INTO subscription_logs(sub_log, paid_amount, paid_by, fk_client_id) ";
    $query .= "VALUES('$sub_log', '$paid', '$paid_by', '$client')";
    $add_sub_log = query($query);
    if ($add_sub_log) {
        // processed subscriptions
        $last_id = mysqli_insert_id($conn);
        $query = "UPDATE student_subscriptions SET fk_sub_log_id='$last_id', `procedure`='processed' ";
        $query .= "WHERE sub_status='on' AND `procedure`='unprocessed' AND fk_sub_log_id='0' ";
        $query .= "AND fk_client_id='$client'";
        $update_subs = query($query);
        if ($update_subs) {
            // Receiving for the school
            $subs_amount_received = $paid + $paid;
            $date = date('y-m-d', time());
            $comment = "Rs.$subs_amount_received received from student subscriptions";
            $query = "INSERT INTO expense_receiving (image, comment, expense, receiving, date, fk_client_id) ";
            $query .= "VALUES ('', '$comment', '0', '$subs_amount_received', '$date', '$client')";
            $add_receiving = mysqli_query($conn, $query);
            // Expense for the school
            $date = date('y-m-d', time());
            $comment = "Rs.$paid paid as subscription share to CodsMine";
            $query = "INSERT INTO expense_receiving (image, comment, expense, receiving, date, fk_client_id) ";
            $query .= "VALUES ('', '$comment', '$paid', '0', '$date', '$client')";
            $add_expense = mysqli_query($conn, $query);

            // fetching the admin id and adding the data
            $id = escape($_SESSION['login_id']);
            $admin_name = escape($_SESSION['login_name']);
            $log = "Admin <strong>$admin_name</strong> paid <strong>Rs.$paid</strong> to CodsMine !";
            $times = date('d/m/Y h:i a', time());
            $times = (string) $times;
            // adding activity into the logs
            $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
            $pass_query2 = mysqli_query($conn, $query);

            redirect("../subs-school.php");
        }
    }
}

// codsmine_paid to school
if (isset($_POST['codsmine_paid'])) {
    $paid = $_POST['paid'];
    $to_school = escape($_SESSION['school_name']);
    $paid_by = "CodsMine";

    // subscription log
    $sub_log = "CodsMine paid <strong>Rs.$paid</strong> to $to_school.";
    $query = "INSERT INTO subscription_logs(sub_log, paid_amount, paid_by, fk_client_id) ";
    $query .= "VALUES('$sub_log', '$paid', '$paid_by', '$client')";
    $add_sub_log = query($query);
    if ($add_sub_log) {
        // processec subscriptions
        $last_id = mysqli_insert_id($conn);
        $query = "UPDATE student_subscriptions SET fk_sub_log_id='$last_id', `procedure`='processed' ";
        $query .= "WHERE sub_status='on' AND `procedure`='unprocessed' AND fk_sub_log_id='0' ";
        $query .= "AND fk_client_id='$client'";
        $update_subs = query($query);
        if ($update_subs) {
            // Receivings for the school
            $date = date('y-m-d', time());
            $comment = "Rs.$paid received as subscription share from CodsMine";
            $query = "INSERT INTO expense_receiving (image, comment, expense, receiving, date, fk_client_id) ";
            $query .= "VALUES ('', '$comment', '0', '$paid', '$date', '$client')";
            $add_receiving = mysqli_query($conn, $query);

            // fetching the admin id and adding the data
            $id = escape($_SESSION['login_id']);
            $admin_name = escape($_SESSION['login_name']);
            $log = "<strong>$admin_name</strong> from Codsmine paid <strong>Rs.$paid</strong> to $to_school !";
            $times = date('d/m/Y h:i a', time());
            $times = (string) $times;
            // adding activity into the logs
            $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
            $pass_query2 = mysqli_query($conn, $query);

            redirect("../subs-codsmine.php");
        }
    }
}
