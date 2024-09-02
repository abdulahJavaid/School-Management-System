<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

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

        $query = "SELECT student_id, fee_amount FROM student_profile WHERE student_status='1'";
        $results = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($results)) {
            $student_id = $row['student_id'];
            $monthly_fee = $row['fee_amount'];

            $query = "INSERT INTO student_fee(fk_student_id, year, month, monthly_fee, due_date, fee_status) ";
            $query .= "VALUES('$student_id', '$year', '$month', '$monthly_fee', '$due_date', '$fee_status')";
            $resultss = query($query);
        }
        redirect("./fee-vouchers.php");
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
                        <div class="col-md-3 mb-3">
                            <form action="" method="post">
                                <button type="submit" name="issue_fees" class="btn btn-sm btn-success w-100">Issue Fees</button>
                            </form>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "<code>Fees for this month is already issued</code>";
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
                        <!-- <div class="col-lg-3 h-100">
                            <div class="d-flex align-items-end">
                            </div>
                        </div> -->
                    </div>
                </form>
            <?php
            }
            ?>
            <?php
            // download vouchers
            if (!isset($_POST['download_vouchers'])) {
            ?>
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <form action="" method="post">
                            <button type="submit" name="download_vouchers" class="btn btn-sm btn-success w-100">Download vouchers</button>
                        </form>
                    </div>
                </div>
            <?php
            }
            // if admin did not selected the class
            if (isset($_GET['m'])) {
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger"><strong>
                                Please Select a class to download vouchers!
                            </strong></div>
                    </div>
                </div>
            <?php
            }
            if (isset($_POST['download_vouchers'])) {
            ?>
                <div class="row mb-3">
                    <form action="generate-pdf.php" method="post">
                        <div class="col-sm-4">
                            <label for="due-date" class="form-label"><strong>Select Class</strong> <code>*</code></label>
                            <div class="col-auto">
                                <div class="input-group">
                                    <select id="inputState" name="select" aria-label="Example input" aria-describedby="button-addon3" class="form-select">
                                        <option selected value="choose_class">Class</option>
                                        <?php
                                        // fetching all the classes 
                                        $result = sql_select_all("all_classes");
                                        while ($row = mysqli_fetch_assoc($result)) {

                                        ?>
                                            <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                                <?php
                                                // fetching the related sections
                                                $result1 = sql_where("class_sections", "fk_class_id", $row['class_id']);
                                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                                ?>
                                                    <option value="<?php echo $row['class_id'] . " " . $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </optgroup>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" name="download_class_vouchers" id="button-addon3" class="btn btn-sm btn-success">
                                        Download Vouchers
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="generate-pdf.php" method="post">
                        <div class="col-sm-4">
                            <label for="due-date" class="form-label"><strong>For School</strong> <code>*</code></label>
                            <div class="col-auto">
                                <div class="input-group">
                                    <input
                                        name="all_students"
                                        type="text"
                                        class="form-control"
                                        aria-label="Example input"
                                        value="All students"
                                        aria-describedby="button-addon2" readonly required />
                                    <button type="submit" name="download_school_vouchers" id="button-addon3" class="btn btn-sm btn-success">
                                        Download Vouchers
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>

        </div>
    </div><!-- End Select Student and add Student -->


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>