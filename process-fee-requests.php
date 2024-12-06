<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'accountant' || $level == 'super') {
} else {
    redirect("./");
}
?>

<?php
// if get request is valid
if (!isset($_GET['id'])) {
    redirect("./fee-requests.php");
}
?>

<?php
$id = escape($_GET['id']);
// rejected fees
if (isset($_POST['rejected']) && !empty($_POST['rejection_reason'])) {
    $id = escape($_POST['id']);
    $rejection_reason = escape($_POST['rejection_reason']);
    $q = "UPDATE student_fee SET fee_method='', payment_date='', fee_status='rejected', admin_remarks='$rejection_reason' ";
    $q .= "WHERE fee_id=$id AND fk_client_id='$client'";
    $result = query($q);
    if ($result) {
        $name = escape($_POST['student_name']);
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> rejected fees of student <strong>$name</strong>!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

        redirect("./fee-requests.php");
    }
} elseif (isset($_POST['rejected']) && empty($_POST['rejection_reason'])) {
    $message = "Please add fee rejection reason!";
}

// fee with dues
if (isset($_POST['due']) && !empty($_POST['dues'])) {
    $id = escape($_POST['id']);
    $dues = escape($_POST['dues']);
    $q2 = "UPDATE student_fee SET fee_status='dues', pending_dues='$dues', admin_remarks='' ";
    $q2 .= "WHERE fee_id='$id' AND fk_client_id='$client'";
    $rs1 = query($q2);
    if ($rs1) {
        $name = escape($_POST['student_name']);
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> accepted fees of student <strong>$name</strong> as paid with some remaining dues!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);


        // addin the receivings
        $date = date('Y-m-d', time());
        $name = escape($_POST['student_name']);
        $reg = escape($_POST['roll_no']);
        $fee = escape($_POST['monthly_fee']);
        $paid = (int) $fee - (int) $dues;
        $comment = "Student $name, reg# $reg paid fee amount Rs.$paid with remaining dues Rs.$dues (Monthly Fee)";
        $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date, fk_client_id) ";
        $qer .= "VALUES ('$comment', '0', '$paid', '$date', '$client')";
        $res = query($qer);
        if ($res) {
            redirect("./fee-requests.php");
        }
    }
} elseif (isset($_POST['due']) && empty($_POST['dues'])) {
    $message = "Please add the remaining dues of the student!";
}

// the fee is totally paid
if (isset($_POST['paid'])) {
    $id = escape($_POST['id']);
    $q2 = "UPDATE student_fee SET fee_status='paid' ";
    $q2 .= "WHERE fee_id='$id' AND fk_client_id='$client'";
    $rs1 = query($q2);
    if ($rs1) {
        $name = escape($_POST['student_name']);
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> accepted fees of student <strong>$name</strong> as totally paid!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);


        // adding the receivings
        $date = date('Y-m-d', time());
        $name = escape($_POST['student_name']);
        $reg = escape($_POST['roll_no']);
        $fee = escape($_POST['total_fee']);
        $comment = "Student $name, reg# $reg paid full fee amount Rs.$fee (Monthly Fee)";
        $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date, fk_client_id) ";
        $qer .= "VALUES ('$comment', '0', '$fee', '$date', '$client')";
        $res = query($qer);
        if ($res) {
            redirect("./fee-requests.php");
        }
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Process Fee</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <?php if (isset($message)) { ?>
        <div class="row">
            <div class="col-xl-8">
                <div class="alert alert-danger">
                    <?php echo $message; ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Student Fee</button>
                            </li>
                        </ul>
                        <?php
                        // get student info
                        $fee_id = escape($_GET['id']);
                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                        $query .= "INNER JOIN student_profile ON ";
                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                        $query .= "WHERE fee_id='$fee_id' AND student_status='1' AND student_fee.fk_client_id='$client'";

                        // looping to get the funds record
                        $result = query($query);
                        $funds = [];
                        $main_data = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $main_id = $row['fee_id'];
                            if (!empty($row['fk_fee_id'])) {
                                if (!isset($funds[$main_id])) {
                                    $funds[$main_id] = [
                                        'funds' => []
                                    ];
                                }
                                $funds[$main_id]['funds'][] = '(' . $row['fund_title'] . ' - ' . $row['fund_amount'] . ') ';
                            }
                            if (!isset($main_data[$main_id])) {
                                $main_data[$main_id] = $row;
                            }
                        }
                        ?>

                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-primary">
                                        <thead>
                                            <tr>
                                                <th scope="col">Reg no#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Monthly Fee</th>
                                                <th scope="col">Funds</th>
                                                <th scope="col">Total Fee</th>
                                                <th scope="col">Month</th>
                                                <th scope="col">Payment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // showing the records in the main table
                                            foreach ($main_data as $rows) {
                                                $current_id = $rows['fee_id'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $rows['roll_no']; ?></td>
                                                    <td><?php echo $rows['name']; ?></td>
                                                    <td>Rs. <?php echo $rows['monthly_fee']; ?></td>
                                                    <td class="text-center">
                                                        <span class="d-inline-block"
                                                            tabindex="0"
                                                            data-bs-toggle="tooltip"
                                                            title="<?php
                                                                    // getting the funds from the loop
                                                                    if (isset($funds[$current_id])) {
                                                                        foreach ($funds[$current_id]['funds'] as $get) {
                                                                            echo $get;
                                                                        }
                                                                    } else {
                                                                        echo "---";
                                                                    }
                                                                    ?>">
                                                            <button type="button" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-question"></i></button>
                                                        </span>

                                                    </td>
                                                    <td>Rs.<?php echo $rows['total_fee']; ?></td>
                                                    <td><?php echo $rows['year'] . ', ' . $rows['month']; ?></td>
                                                    <td><?php echo $rows['payment_date']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                // loop for getting the student data
                                foreach ($main_data as $rows) {
                                ?>
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" id="">
                                        <input type="hidden" name="student_id" value="<?php echo $rows['student_id']; ?>" id="">
                                        <input type="hidden" name="student_name" value="<?php echo $rows['name']; ?>" id="">
                                        <input type="hidden" name="roll_no" value="<?php echo $rows['roll_no']; ?>" id="">
                                        <input type="hidden" name="total_fee" value="<?php echo $rows['total_fee']; ?>" id="">
                                        <input type="hidden" name="year" value="<?php echo $rows['year']; ?>" id="">
                                        <input type="hidden" name="month" value="<?php echo $rows['month']; ?>" id="">
                                        <div class="row mb-3">
                                            <div class="col-md-8 col-lg-9 mt-2">
                                                <input name="dues" type="text" class="form-control" value="" placeholder="Remaining dues (if fees is not full paid)">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-8 col-lg-9 mt-2">
                                                <input name="rejection_reason" type="text" class="form-control" value="" placeholder="Give reason (if rejected)">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="paid" class="btn btn-sm btn-success">Full Paid</button>
                                            <button type="submit" name="due" class="btn btn-sm btn-primary">Add dues</button>
                                            <button type="submit" name="rejected" class="btn btn-sm btn-danger">Rejected</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                <?php
                                }
                                ?>

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
            <div class="col-xl-4">
                <div class="card">
                    <?php
                    foreach ($main_data as $rows) {
                        if (str_contains(strtolower($rows['fee_method']), 'cash')) {
                            $img = "image-by-cash-default-admin.jpg";
                            echo "<img src='uploads/fees/$img' alt='no-img'>";
                        } else {
                            $img = $rows['receipt_image'];
                            echo "<img src='uploads/fees/$img' alt='no-img'>";
                        }
                    ?>
                        <div class="card-body">
                            <h5 class="card-title">
                            <?php
                            if (str_contains(strtolower($rows['fee_method']), 'cash')) {
                                echo "Paid by Cash";
                            } else {
                                $img = $rows['receipt_image'];
                                echo "Payment Receipt";
                            }
                        }
                            ?>
                            </h5>
                        </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>