<?php
// search studetns for fees/dues
// inclusion of required files and functions
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// Set the content type to JSON
header('Content-Type: application/json');

// getting the client id
$client = escape($_SESSION['client_id']);

// to get all the students whose fees is unpaid
if (isset($_POST['allQueryF'])) {

    $year = date('Y', time());
    $month = date('F', time());

    // SQL query to search for matches
    $query = "SELECT student_profile.name, student_profile.roll_no FROM student_profile INNER JOIN student_fee ON ";
    $query .= "student_profile.student_id=student_fee.fk_student_id ";
    $query .= "WHERE fee_status='unpaid' ";
    $query .= "AND student_status='1' AND student_profile.fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // if (isset($matches['roll_no'])) {
        foreach ($matches as $match) {
            if ($match['roll_no'] == $row['roll_no']) {
                continue 2;
            }
            // }
        }
        $matches[] = [
            'roll_no' => $row['roll_no'],
            'name' => $row['name']
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// to get all the students whose dues are pending
if (isset($_POST['allQueryD'])) {

    $year = date('Y', time());
    $month = date('F', time());

    // SQL query to search for matches
    $query = "SELECT student_profile.name, student_profile.roll_no FROM student_profile INNER JOIN student_fee ON ";
    $query .= "student_profile.student_id=student_fee.fk_student_id ";
    $query .= "WHERE fee_status LIKE '%due%' ";
    $query .= "AND student_status='1' AND student_profile.fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // if (isset($matches['roll_no'])) {
        foreach ($matches as $match) {
            if ($match['roll_no'] == $row['roll_no']) {
                continue 2;
            }
            // }
        }
        $matches[] = [
            'roll_no' => $row['roll_no'],
            'name' => $row['name']
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// to search for students whose fee is unpaid
if (isset($_POST['searchFee'])) {
    $search = escape($_POST['searchFee']);

    // SQL query to search for matches
    $query = "SELECT student_profile.name, student_profile.roll_no FROM student_profile INNER JOIN student_fee ON ";
    $query .= "student_profile.student_id=student_fee.fk_student_id ";
    $query .= "WHERE fee_status='unpaid' ";
    $query .= "AND student_status='1' ";
    $query .= "AND (`name` LIKE '$search%' OR roll_no='$search') ";
    $query .= "AND student_profile.fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // if (isset($matches['roll_no'])) {
        foreach ($matches as $match) {
            if ($match['roll_no'] == $row['roll_no']) {
                continue 2;
            }
            // }
        }
        $matches[] = [
            'roll_no' => $row['roll_no'],
            'name' => $row['name']
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// to search for students whose dues are pending
if (isset($_POST['searchDues'])) {
    $search = escape($_POST['searchDues']);

    // SQL query to search for matches
    $query = "SELECT student_profile.name, student_profile.roll_no FROM student_profile INNER JOIN student_fee ON ";
    $query .= "student_profile.student_id=student_fee.fk_student_id ";
    $query .= "WHERE fee_status LIKE '%due%' ";
    $query .= "AND student_status='1' ";
    $query .= "AND (`name` LIKE '$search%' OR roll_no='$search') ";
    $query .= "AND student_profile.fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and store them in the $matches array$results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // if (isset($matches['roll_no'])) {
        foreach ($matches as $match) {
            if ($match['roll_no'] == $row['roll_no']) {
                continue 2;
            }
            // }
        }
        $matches[] = [
            'roll_no' => $row['roll_no'],
            'name' => $row['name']
        ];
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// unpaid student fee
if (isset($_POST['unpaidFee'])) {
    $roll_no = escape($_POST['unpaidFee']);
    $query = "SELECT student_profile.roll_no, student_profile.name, ";
    $query .= "student_profile.student_id, student_fee.*, student_funds.* ";
    $query .= "FROM student_fee LEFT JOIN student_funds ON ";
    $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
    $query .= "INNER JOIN student_profile ON ";
    $query .= "student_fee.fk_student_id=student_profile.student_id ";
    $query .= "WHERE roll_no='$roll_no' AND student_status='1' ";
    $query .= "AND fee_status='unpaid' ";
    $query .= "AND student_fee.fk_client_id='$client'";

    $result = mysqli_query($conn, $query);
    $matches = [];

    // Fetch results and organize them
    while ($row = mysqli_fetch_assoc($result)) {
        $main_id = $row['fee_id'];

        // Initialize entry if it doesn't exist
        if (!isset($matches[$main_id])) {
            $matches[$main_id] = [
                'main_data' => $row,
                'funds' => []
            ];
        }

        // Add fund details if present
        if (!empty($row['fk_fee_id'])) {
            $matches[$main_id]['funds'][] = '(' . $row['fund_title'] . ' - ' . $row['fund_amount'] . ')';
        }
    }

    // Return the results as a JSON response
    echo json_encode($matches);
}

// the fee is totally paid
if (isset($_POST['all_fee_clear'])) {
    $id = escape($_POST['fee_id']);
    $this_day = date('Y-m-d', time());
    $q2 = "UPDATE student_fee SET fee_status='paid', fee_method='admin', payment_date='$this_day' ";
    $q2 .= "WHERE fee_id='$id' AND fk_client_id='$client'";
    $rs1 = query($q2);
    if ($rs1) {
        $name = escape($_POST['name']);
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> marked fees of student <strong>$name</strong> as totally paid!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);


        // adding the receivings
        $date = date('Y-m-d', time());
        $name = escape($_POST['name']);
        $reg = escape($_POST['roll_no']);
        $fee = escape($_POST['total_fee']);
        $comment = "Student $name, reg# $reg paid full fee amount Rs.$fee (Monthly Fee)";
        $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date, fk_client_id) ";
        $qer .= "VALUES ('$comment', '0', '$fee', '$date', '$client')";
        $res = query($qer);
        $matches = [];
        if ($res) {
            // redirect("./fee-requests.php");
            $matches[] = [
                'message' => 'The fee is marked as paid!'
            ];
        } else {
            $matches[] = [
                'message' => 'An error occured, try again!'
            ];
        }

        // Return the results as a JSON response
        echo json_encode($matches);
    }
}

// fee is paid with dues
if (isset($_POST['fee_clear_dues'])) {
    $id = escape($_POST['fee_id']);
    $dues = escape($_POST['dues']);
    $q2 = "UPDATE student_fee SET fee_status='dues', fee_method='admin', pending_dues='$dues', admin_remarks='' ";
    $q2 .= "WHERE fee_id='$id' AND fk_client_id='$client'";
    $rs1 = query($q2);
    if ($rs1) {
        $name = escape($_POST['name']);
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> marked fees of student <strong>$name</strong> as paid with some remaining dues!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);


        // addin the receivings
        $date = date('Y-m-d', time());
        $name = escape($_POST['name']);
        $reg = escape($_POST['roll_no']);
        $fee = escape($_POST['total_fee']);
        $paid = (int) $fee - (int) $dues;
        $comment = "Student $name, reg# $reg paid fee amount Rs.$paid with remaining dues Rs.$dues (Monthly Fee)";
        $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date, fk_client_id) ";
        $qer .= "VALUES ('$comment', '0', '$paid', '$date', '$client')";
        $res = query($qer);
        $matches = [];
        if ($res) {
            $matches[] = [
                'message' => 'Fee marked as paid with some dues!'
            ];
        } else {
            $matches[] = [
                'message' => 'An error occured, try again!'
            ];
        }

        // Return the results as a JSON response
        echo json_encode($matches);
    }
}
