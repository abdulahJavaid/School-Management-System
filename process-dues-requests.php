<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// checking session for appropriate access
if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'accountant' || $_SESSION['login_access'] == 'super') {
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
// rejected dues
if (isset($_POST['reject']) && !empty($_POST['rejection_reason'])) {
    // echo $_GET['id'];
    $std_id = escape($_POST['student_id']);
    $rejection_reason = escape($_POST['rejection_reason']);
    $query = "SELECT * FROM student_fee WHERE fk_student_id='$std_id' ";
    $query .= "AND fee_status LIKE '%due%'";
    $res = query($query);
    while ($row = mysqli_fetch_assoc($res)) {
        $fee_id = escape($row['fee_id']);
        $q = "UPDATE student_fee SET fee_method='', payment_date='', fee_status='dues', admin_remarks='$rejection_reason' ";
        $q .= "WHERE fee_id='$fee_id'";
        $result = query($q);
    }
    redirect("./dues-requests.php");
} elseif (isset($_POST['reject']) && empty($_POST['rejection_reason'])) {
    $message = "Please add dues rejection reason!";
}

// process dues
if (isset($_POST['clear_dues']) && !empty($_POST['dues_amount'])) {
    $total_paid = (int) $_POST['dues_amount'];
    $paid_amount = escape($_POST['dues_amount']);
    $std_id = escape($_POST['student_id']);
    $query = "SELECT * FROM student_fee WHERE fk_student_id='$std_id' ";
    $query .= "AND fee_status LIKE '%due%'";
    $res = query($query);
    while ($row = mysqli_fetch_assoc($res)) {
        $fee_id = escape($row['fee_id']);
        $dues = (int) $row['pending_dues'];

        if ($total_paid >= $dues) {
            $q = "UPDATE student_fee SET fee_status='paid', pending_dues='0' ";
            $q .= "WHERE fee_id='$fee_id'";
            $total_paid -= $dues;
        } elseif ($total_paid < $dues) {
            $dues = $dues - $total_paid;
            $q = "UPDATE student_fee SET fee_status='dues', pending_dues='$dues' ";
            $q .= "WHERE fee_id='$fee_id'";
            $total_paid = 0;
        }
        $result = query($q);
    }
    // if ($rs1) {
    $date = date('Y-m-d', time());
    $name = escape($_POST['name']);
    $reg = escape($_POST['roll_no']);
    $comment = "Student $name, reg# $reg paid dues amount Rs.$paid_amount (Pending Dues)";
    $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date) ";
    $qer .= "VALUES ('$comment', '0', '$paid_amount', '$date')";
    $res = query($qer);
    if ($res) {
        redirect("./dues-requests.php");
    }
    // }
} elseif (isset($_POST['clear_dues']) && empty($_POST['dues_amount'])) {
    $message = "Please add the amount (Rs.) that student paid";
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Student Dues</button>
                            </li>
                        </ul>
                        <?php
                        ?>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <th scope="col">Reg no#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Dues</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // get student info
                                        $std_id = escape($_GET['id']);
                                        // $query = "SELECT * FROM student_fee INNER JOIN ";
                                        // $query .= "student_profile ON student_fee.fk_student_id=student_profile.student_id ";
                                        // $query .= "WHERE fee_id='$std_id' AND fee_status='dues_request' OR fee_status='due_request' OR fee_status='dues'";
                                        $query = "SELECT * FROM student_profile WHERE student_id='$std_id'";
                                        $result = query($query);
                                        $row = mysqli_fetch_assoc($result);
                                        $query = "SELECT * FROM student_fee WHERE fk_student_id='$std_id' ";
                                        $query .= "AND fee_status='dues' OR fee_status='dues_request' OR fee_status='due_request'";
                                        $result = query($query);
                                        $total_dues = 0;
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $rows['year'] . ', ' . $rows['month'] ?></td>
                                                <td>Rs. <?php echo $rows['pending_dues']; ?></td>
                                            </tr>
                                        <?php
                                            $total_dues += $rows['pending_dues'];
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3"><strong>Total Dues</strong></td>
                                            <td>Rs. <?php echo $total_dues; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                // getting the date where the request was put
                                $query = "SELECT * FROM student_fee WHERE fk_student_id='$std_id' ";
                                $query .= "AND fee_status='dues_request' OR fee_status='due_request'";
                                $result = query($query);
                                $rows = mysqli_fetch_assoc($result);
                                ?>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="due_request_id" value="<?php echo $rows['fee_id']; ?>">
                                    <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                                    <input type="hidden" name="total_dues" value="<?php echo $total_dues; ?>">
                                    <input type="hidden" name="roll_no" value="<?php echo $row['roll_no']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                    <!-- <input type="hidden" name="monthly_fee" value="<?php //echo $rows['monthly_fee']; 
                                                                                        ?>" id="">
                                    <input type="hidden" name="year" value="<?php //echo $rows['year']; 
                                                                            ?>" id="">
                                    <input type="hidden" name="month" value="<?php //echo $rows['month']; 
                                                                                ?>" id=""> -->
                                    <div class="row">
                                        <div class="container">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="input-group">
                                                        <input
                                                            name="dues_amount"
                                                            type="text"
                                                            size="30"
                                                            class="form-control"
                                                            placeholder="Amount (Rs.) that student paid"
                                                            aria-label="Example input"
                                                            aria-describedby="button-addon2" />
                                                        <button name="clear_dues" class="btn btn-sm btn-success" type="submit" id="button-addon2">
                                                            Clear Dues
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row">
                                        <div class="container">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="input-group">
                                                        <input
                                                            name="rejection_reason"
                                                            type="text"
                                                            size="40"
                                                            class="form-control"
                                                            placeholder="Reason for rejection"
                                                            aria-label="Example input"
                                                            aria-describedby="button-addon2" />
                                                        <button name="reject" class="btn btn-sm btn-danger" type="submit" id="button-addon2">
                                                            Reject
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-3">
                                        <div class="col-md-8 col-lg-9">
                                            <input name="rejection_reason" type="text" class="form-control" value="" placeholder="Add reason (if rejected)">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="paid" class="btn btn-sm btn-success">Mark Paid</button>
                                        <button type="submit" name="due" class="btn btn-sm btn-primary">Add dues</button>
                                        <button type="submit" name="rejected" class="btn btn-sm btn-danger">Rejected</button>
                                    </div> -->
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
            <div class="col-xl-4">
                <div class="card">
                    <?php
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