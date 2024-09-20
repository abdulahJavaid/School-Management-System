<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Fee Vouchers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <?php
    // issue fees to whole school
    if (isset($_POST['issued_fees'])) {
        $due_date = escape($_POST['last_date']);
        $month = date('F');
        $year = date('Y');
        $fee_status = 'unpaid';

        $query = "SELECT student_id, fee_amount FROM student_profile WHERE student_status='1' AND fk_client_id='$client'";
        $results = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($results)) {
            $student_id = $row['student_id'];
            $monthly_fee = $row['fee_amount'];

            $query = "INSERT INTO student_fee(fk_student_id, year, month, monthly_fee, due_date, fee_status, fk_client_id) ";
            $query .= "VALUES('$student_id', '$year', '$month', '$monthly_fee', '$due_date', '$fee_status', '$client')";
            $resultss = query($query);

            // adding the fee notices for the student
            $today = date('Y-m-d', time());
            $description = "Your Fees for this month has been issued!";
            $query = "INSERT INTO notices(fk_student_id, notice_description, notice_status, notice_date, fk_client_id) ";
            $query .= "VALUES('$student_id', '$description', 'student', '$today', '$client')";
            $resultsss = query($query);
        }
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> issued Fees to all students !";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

        redirect("./issue-fee.php");
    }
    ?>

    <!-- class and sections -->
    <div class="pagetitle">
        <div class="row">

            <?php
            // seeing if the fee is already issued
            $month = date('F');
            $year = date('Y');
            $query = "SELECT * FROM student_fee WHERE month='$month' AND year='$year'";
            $feees = query($query);
            if (mysqli_num_rows($feees) == 0) {
                // issue fees
                if (!isset($_POST['issue_fees'])) {
            ?>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <form action="" method="post">
                                <button type="submit" name="issue_fees" class="btn btn-sm btn-success w-100">Issue Fees</button>
                            </form>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "<code class='mb-3'>- Fees for this month is already issued</code>";
            }
            if (isset($_POST['issue_fees'])) {
                ?>
                <form action="" method="post">
                    <div class="row mb-3">
                        <p><code>Fee will be issued to whole school for </code><?php echo date('Y') . ', ' . date('F'); ?></p>
                        <div class="col-sm-4">
                            <label for="due-date" class="form-label"><strong>Fees Last date</strong> <code>*</code></label>

                            <div class="col-auto">
                                <div class="input-group">
                                    <input
                                        name="last_date"
                                        type="date"
                                        class="form-control"
                                        aria-label="Example input"
                                        aria-describedby="button-addon2" required />

                                    <button type="submit" name="issued_fees" id="button-addon2" class="btn btn-sm btn-success">
                                        Issue Fees
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
            }
            ?>

            <?php
            // adding unpaid fees to dues
            if (isset($_POST['add_unpaid'])) {
                $query = "SELECT * FROM student_fee ";
                $query .= "WHERE fee_status='unpaid' OR fee_status='rejected' ";
                $query .= "AND student_fee.fk_client_id='$client'";
                $get_unpaid = query($query);
                while ($row = mysqli_fetch_assoc($get_unpaid)) {
                    $fee_id = $row['fee_id'];
                    $fee = $row['monthly_fee'];

                    $query = "UPDATE student_fee SET fee_status='dues', pending_dues='$fee' ";
                    $query .= "WHERE fee_id='$fee_id' AND fk_client_id='$client'";
                    $get_result = query($query);
                }
                // fetching the admin id and adding the data
                $admin_name = escape($_SESSION['login_name']);
                $log = "Admin <strong>$admin_name</strong> added unpaid fees to students pending dues !";
                $times = date('d/m/Y h:i a', time());
                $times = (string) $times;
                // adding activity into the logs
                $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
                $pass_query2 = mysqli_query($conn, $query);

                redirect("./issue-fee.php");
            }
            ?>


            <?php
            // if there are unapid fees of the month
            $query = "SELECT * FROM student_fee ";
            $query .= "WHERE fee_status='unpaid' OR fee_status='rejected' ";
            $query .= "AND student_fee.fk_client_id='$client'";
            $check_fee = query($query);
            if (mysqli_num_rows($check_fee) != 0) {
            ?>
                <form action="" method="post">
                    <div class="row mb-3">

                        <code>- Unpaid fees will be added to pending fees/dues of students</code>
                        <div class="col-sm-4">
                            <button type="submit" name="add_unpaid" class="btn btn-sm btn-success">Add to Dues</button>
                        </div>
                    </div>
                </form>
            <?php } ?>





        </div>
    </div><!-- End Select Student and add Student -->


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>