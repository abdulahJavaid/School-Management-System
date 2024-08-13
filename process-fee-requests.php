<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// checking session for appropriate access
if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'accountant' || $_SESSION['login_access'] == 'super') {
    redirect("./");
}
?>

<?php
// if get request is valid
if (!isset($_GET['id'])) {
    redirect("./pending-fee-requests.php");
}
?>

<?php
$id = $_GET['id'];
// rejected fees
if (isset($_POST['rejected']) && !empty($_POST['rejection_reason'])) {
    // echo $_GET['id'];
    $id = $_POST['id'];
    // echo $_GET['id'];
    $rejection_reason = $_POST['rejection_reason'];
    $q = "UPDATE fee_requests SET fee_method='', fee_request_status='rejected', rejection_reason='$rejection_reason' ";
    $q .= "WHERE fee_request_id=$id";
    $result = query($q);
    if ($result) {
        redirect("./pending-fee-requests.php");
    }
} elseif (isset($_POST['rejected']) && empty($_POST['rejection_reason'])) {
    $message = "Please add fee rejection reason!";
}

// fee with dues
if (isset($_POST['due']) && !empty($_POST['dues'])) {
    $id = $_POST['id'];
    $q1 = "UPDATE fee_requests SET fee_request_status='paid' ";
    $q1 .= "WHERE fee_request_id=$id";
    $rs = query($q1);
    if ($rs) {
        $student_id = $_POST['student_id'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $dues = $_POST['dues'];
        $q2 = "INSERT INTO student_fee (fk_student_id, fk_fee_request_id, year, month, fee_status, pending_dues) ";
        $q2 .= "VALUES ('$student_id', '$id', '$year', '$month', 'dues', '$dues')";
        $rs1 = query($q2);
        if ($rs1) {
            redirect("./pending-fee-requests.php");
        }
    }
} elseif (isset($_POST['due']) && empty($_POST['dues'])) {
    $message = "Please add the remaining dues of the student!";
}

// the fee is totally paid
if (isset($_POST['paid'])) {
    $id = $_POST['id'];
    $q1 = "UPDATE fee_requests SET fee_request_status='paid' ";
    $q1 .= "WHERE fee_request_id=$id";
    $rs = query($q1);
    if ($rs) {
        $student_id = $_POST['student_id'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $q2 = "INSERT INTO student_fee (fk_student_id, fk_fee_request_id, year, month, fee_status) ";
        $q2 .= "VALUES ('$student_id', '$id', '$year', '$month', 'paid')";
        $rs1 = query($q2);
        if ($rs1) {
            redirect("./pending-fee-requests.php");
        }
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Process Fee</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">School name here</li>
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
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Student Fee</button>
                            </li>
                        </ul>
                        <?php
                        // get student info
                        $fee_request_id = $_GET['id'];
                        $query = "SELECT * FROM fee_requests INNER JOIN ";
                        $query .= "student_profile ON fee_requests.fk_student_id=student_profile.student_id ";
                        $query .= "WHERE fee_request_id='$fee_request_id'";
                        $result = query($query);
                        $rows = mysqli_fetch_assoc($result);
                        ?>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <th scope="col">Reg no#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Total Fee (Rs)</th>
                                            <th scope="col">Fee Month</th>
                                            <th scope="col">Fee Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $rows['roll_no']; ?></td>
                                            <td><?php echo $rows['name']; ?></td>
                                            <td>Rs. <?php echo $rows['fee_amount']; ?></td>
                                            <td><?php echo $rows['year'] . ', ' . $rows['month']; ?></td>
                                            <td><?php echo $rows['fee_method']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" id="">
                                    <input type="hidden" name="student_id" value="<?php echo $rows['student_id']; ?>" id="">
                                    <input type="hidden" name="year" value="<?php echo $rows['year']; ?>" id="">
                                    <input type="hidden" name="month" value="<?php echo $rows['month']; ?>" id="">
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dues" type="text" class="form-control" value="" placeholder="Add dues (if any)">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-lg-9">
                                            <input name="rejection_reason" type="text" class="form-control" value="" placeholder="Add reason (if rejected)">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="paid" class="btn btn-sm btn-success">Mark Paid</button>
                                        <button type="submit" name="due" class="btn btn-sm btn-primary">Add dues</button>
                                        <button type="submit" name="rejected" class="btn btn-sm btn-danger">Rejected</button>
                                    </div>
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
                        $img = $row['image'];
                        echo "<img src='uploads/fees/$img' alt='no-img'>";
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                            if (str_contains(strtolower($rows['fee_method']), 'cash')) {
                                echo "Paid by Cash";
                            } else {
                                $img = $rows['image'];
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