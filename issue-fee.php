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

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Issue Fees</h1>
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

        $query = "SELECT student_id, fee_amount FROM student_profile ";
        $query .= "LEFT JOIN student_fee ON student_profile.student_id=student_fee.fk_student_id ";
        $query .= "AND month='$month' AND year='$year' ";
        $query .= "WHERE student_status='1' AND student_profile.fk_client_id='$client' ";
        $query .= "AND fk_student_id IS NULL";
        $results = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($results)) {
            $student_id = $row['student_id'];
            $monthly_fee = $row['fee_amount'];

            // calculating the total fees
            $total_fee = (int) $monthly_fee;
            if (!empty($_POST['fund1'])) {
                $total_fee += (int) $_POST['fund1'];
            }
            if (!empty($_POST['fund2'])) {
                $total_fee += (int) $_POST['fund2'];
            }
            if (!empty($_POST['fund3'])) {
                $total_fee += (int) $_POST['fund3'];
            }
            if (!empty($_POST['fund4'])) {
                $total_fee += (int) $_POST['fund4'];
            }
            $total_fee = (string) $total_fee;

            $query = "INSERT INTO student_fee(fk_student_id, year, month, monthly_fee, total_fee, due_date, fee_status, fk_client_id) ";
            $query .= "VALUES('$student_id', '$year', '$month', '$monthly_fee', '$total_fee', '$due_date', '$fee_status', '$client')";
            $resultss = query($query);

            $last_id = last_id();
            // adding the funds if any
            if (!empty($_POST['fund1'])) {
                $fund1t = $_POST['fund1t'];
                $fund1 = $_POST['fund1'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund1t', '$fund1', '$client')";
                $pass_fund1 = query($query);
            }
            if (!empty($_POST['fund2'])) {
                $fund2t = $_POST['fund2t'];
                $fund2 = $_POST['fund2'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund2t', '$fund2', '$client')";
                $pass_fund2 = query($query);
            }
            if (!empty($_POST['fund3'])) {
                $fund3t = $_POST['fund3t'];
                $fund3 = $_POST['fund3'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund3t', '$fund3', '$client')";
                $pass_fund3 = query($query);
            }
            if (!empty($_POST['fund4'])) {
                $fund4t = $_POST['fund4t'];
                $fund4 = $_POST['fund4'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund4t', '$fund4', '$client')";
                $pass_fund4 = query($query);
            }

            // adding the fee notices for the student
            $today = date('Y-m-d', time());
            $description = "Your Fees for this month has been issued!";
            $query = "INSERT INTO notices(fk_student_id, notice_description, notice_status, notice_date, fk_client_id) ";
            $query .= "VALUES('$student_id', '$description', 'student', '$today', '$client')";
            $resultsss = query($query);
        }
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> issued Fees to students !";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

        redirect("./issue-fee.php");
    }

    // issue fees to one section
    if (isset($_POST['issued_class_fees'])) {
        // Selecting students from the specified class
        $fetch = $_POST['select'];
        $length = strlen($fetch);
        $find = strpos($fetch, ' ');
        $number = $find + 1;
        $useable = $length - $number;
        $useable1 = $find;
        $section = substr($fetch, -$useable);
        $class = substr($fetch, 0, $find);
        $section = (int) $section;
        $class = (int) $class;
        $section = escape($section);
        $class = escape($class);

        $due_date = $_POST['last_date'];
        $month = date('F');
        $year = date('Y');
        $fee_status = 'unpaid';

        $query = "SELECT * FROM all_classes LEFT JOIN class_sections ON ";
        $query .= "all_classes.class_id=class_sections.fk_class_id LEFT JOIN student_class ON ";
        $query .= "class_sections.section_id=student_class.fk_section_id LEFT JOIN ";
        $query .= "student_profile ON student_class.fk_student_id=student_profile.student_id ";
        $query .= "LEFT JOIN student_fee ON student_profile.student_id=student_fee.fk_student_id ";
        $query .= "AND month='$month' AND year='$year' ";
        $query .= "WHERE class_id='$class' AND section_id='$section' AND ";
        $query .= "all_classes.fk_client_id='$client' AND student_profile.student_status='1' ";
        $query .= "AND student_fee.fk_student_id IS NULL";
        $results = query($query);
        $class_name = "";
        $section_name = "";
        while ($row = mysqli_fetch_array($results)) {
            if (empty($class_name)) {
                // getting class name for logs
                $class_name = $row['class_name'];
            }
            if (empty($section_name)) {
                // getting section name for logs
                $section_name = $row['section_name'];
            }
            $student_id = $row['student_id'];
            $monthly_fee = $row['fee_amount'];

            // calculating the total fees
            $total_fee = (int) $monthly_fee;
            if (!empty($_POST['fund5'])) {
                $total_fee += (int) $_POST['fund5'];
            }
            if (!empty($_POST['fund6'])) {
                $total_fee += (int) $_POST['fund6'];
            }
            if (!empty($_POST['fund7'])) {
                $total_fee += (int) $_POST['fund7'];
            }
            if (!empty($_POST['fund8'])) {
                $total_fee += (int) $_POST['fund8'];
            }
            $total_fee = (string) $total_fee;

            $query = "INSERT INTO student_fee(fk_student_id, year, month, monthly_fee, total_fee, due_date, fee_status, fk_client_id) ";
            $query .= "VALUES('$student_id', '$year', '$month', '$monthly_fee', '$total_fee', '$due_date', '$fee_status', '$client')";
            $resultss = query($query);

            $last_id = last_id();
            // adding the funds if any
            if (!empty($_POST['fund5'])) {
                $fund5t = $_POST['fund5t'];
                $fund5 = $_POST['fund5'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund5t', '$fund5', '$client')";
                $pass_fund1 = query($query);
            }
            if (!empty($_POST['fund6'])) {
                $fund6t = $_POST['fund6t'];
                $fund6 = $_POST['fund6'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund6t', '$fund6', '$client')";
                $pass_fund2 = query($query);
            }
            if (!empty($_POST['fund7'])) {
                $fund7t = $_POST['fund7t'];
                $fund7 = $_POST['fund7'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund7t', '$fund7', '$client')";
                $pass_fund3 = query($query);
            }
            if (!empty($_POST['fund8'])) {
                $fund8t = $_POST['fund8t'];
                $fund8 = $_POST['fund8'];
                $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
                $query .= "VALUES('$last_id', '$fund8t', '$fund8', '$client')";
                $pass_fund4 = query($query);
            }

            // adding the fee notices for the student
            $today = date('Y-m-d', time());
            $description = "Your Fees for this month has been issued!";
            $query = "INSERT INTO notices(fk_student_id, notice_description, notice_status, notice_date, fk_client_id) ";
            $query .= "VALUES('$student_id', '$description', 'student', '$today', '$client')";
            $resultsss = query($query);
        }
        // fetching the admin id and adding the data
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> issued Fees to students of <strong>$class_name $section_name</strong> !";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

        redirect("./issue-fee.php");
    }
    ?>

    <div class="pagetitle">
        <div class="row">

            <?php
            // seeing if the fee is already issued

            // getting total students
            $month = date('F');
            $year = date('Y');
            $query = "SELECT * FROM student_profile WHERE fk_client_id='$client' AND student_status='1'";
            $get_all_students = query($query);
            $total_students = mysqli_num_rows($get_all_students);
            // getting the issued fees
            $query = "SELECT * FROM student_fee WHERE month='$month' AND year='$year' ";
            $query .= "AND fk_client_id='$client'";
            $feees = query($query);
            if ($total_students > mysqli_num_rows($feees)) {
                // issue fees
                if (!isset($_GET['issue_fees'])) {
            ?>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <form action="" method="get">
                                <button type="submit" name="issue_fees" class="btn btn-sm btn-success w-100">Issue Fees</button>
                            </form>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "<code class='mb-3'>- Fees for this month is already issued</code>";
            }
            // if the admin wants to issue fees
            if (isset($_GET['issue_fees'])) {

                // getting the current month and year
                $month = date('F', time());
                $year = date('Y', time());
                // issue fees class wise
                $query = "SELECT * FROM class_sections LEFT JOIN student_class ON ";
                $query .= "class_sections.section_id=student_class.fk_section_id LEFT JOIN ";
                $query .= "student_profile ON student_class.fk_student_id=student_profile.student_id ";
                $query .= "LEFT JOIN student_fee ON student_profile.student_id=student_fee.fk_student_id ";
                $query .= "AND month='$month' AND year='$year' ";
                $query .= "WHERE class_sections.fk_client_id='$client' AND student_profile.student_status='1' ";
                $query .= "AND student_fee.fk_student_id IS NULL";
                $all_section_fee = query($query);
                if (mysqli_num_rows($all_section_fee) != 0) {
                ?>
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-header card-bg-header text-dark mb-3">
                                <h5 class="mb-0">
                                    <strong>Issue Fees(class) - </strong><?php echo date('Y') . ', ' . date('F'); ?>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="Fees & funds will be issued class wise, if fee is issued to all class students then fees cannot be issued. If even one student is missing the fees can be issued.">
                                        <button type="button" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-question"></i></button>
                                    </span>
                                </h5>
                            </div>
                            <div class="row mb-3 px-3">
                                <div class="col-sm-4 order-1 order-sm-1 mb-1">
                                    <label for="class-fees" class="form-label"><strong>Select Class</strong> <code>*</code></label>

                                    <div class="col-auto">
                                        <div class="input-group">
                                            <select id="inputState"
                                                name="select"
                                                aria-label="Example select"
                                                class="form-select"
                                                required>
                                                <option value="" disabled selected>Choose Class</option>
                                                <?php
                                                // getting the current month and year
                                                $month = date('F', time());
                                                $year = date('Y', time());
                                                // fetching all the classes
                                                $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                                                $result = query($query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $clas_id = $row['class_id'];
                                                ?>
                                                    <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                                        <?php
                                                        // fetching the related sections
                                                        $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                                        $result1 = query($query);
                                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                                            $sect_id = $row1['section_id'];
                                                            $sect_name = $row1['section_name'];
                                                            $query = "SELECT * FROM class_sections LEFT JOIN student_class ON ";
                                                            $query .= "class_sections.section_id=student_class.fk_section_id LEFT JOIN ";
                                                            $query .= "student_profile ON student_class.fk_student_id=student_profile.student_id ";
                                                            $query .= "LEFT JOIN student_fee ON student_profile.student_id=student_fee.fk_student_id ";
                                                            $query .= "AND month='$month' AND year='$year' ";
                                                            $query .= "WHERE section_name='$sect_name' AND section_id='$sect_id' AND ";
                                                            $query .= "student_profile.student_status='1' ";
                                                            $query .= "AND class_sections.fk_client_id='$client' AND ";
                                                            $query .= "student_fee.fk_student_id IS NULL";
                                                            $section_fee = query($query);
                                                            if (mysqli_num_rows($section_fee) != 0) {
                                                        ?>
                                                                <option value="<?php echo $row['class_id'] . " " . $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $row['class_id'] . " " . $row1['section_id']; ?>" disabled><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </optgroup>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4 order-3 order-sm-2 mb-1">
                                    <div class="form-check ps-5" id="fund5">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_fund()" value="" id="fund5_ch">
                                        <label class="form-check-label" for="fund5">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund5_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_five_t"
                                                    name="fund5t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_five"
                                                    name="fund5"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 order-4 order-sm-3 mb-1">
                                    <div class="form-check ps-5" id="fund6">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_fund()" value="" id="fund6_ch">
                                        <label class="form-check-label" for="fund6">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund6_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_six_t"
                                                    name="fund6t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_six"
                                                    name="fund6"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 order-2 order-sm-4 mb-1">
                                    <label for="due-date" class="form-label"><strong>Fees Last date</strong> <code>*</code></label>

                                    <div class="col-auto">
                                        <div class="input-group">
                                            <input
                                                name="last_date"
                                                type="date"
                                                class="form-control"
                                                aria-label="Example input"
                                                aria-describedby="button-addon2" required />

                                            <button type="submit" name="issued_class_fees" id="button-addon3" class="btn btn-sm btn-success">
                                                Issue Fees
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 order-sm-5 order-5 mb-1">
                                    <div class="form-check ps-5" id="fund7">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_fund()" value="" id="fund7_ch">
                                        <label class="form-check-label" for="fund7">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund7_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_seven_t"
                                                    name="fund7t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_seven"
                                                    name="fund7"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 order-sm-5 order-5 mb-1">
                                    <div class="form-check ps-5" id="fund8">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_fund()" value="" id="fund8_ch">
                                        <label class="form-check-label" for="fund8">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund8_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_eight_t"
                                                    name="fund8t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_eight"
                                                    name="fund8"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>


            <?php
                } // end of if - issue fees section wise
                
                // issue fees to all school
                // getting total students
                $month = date('F');
                $year = date('Y');
                $query = "SELECT * FROM student_profile WHERE fk_client_id='$client' AND student_status='1'";
                $get_all_students = query($query);
                $total_students = mysqli_num_rows($get_all_students);
                // getting issued fees
                $query = "SELECT * FROM student_fee WHERE month='$month' AND year='$year' ";
                $query .= "AND fk_client_id='$client'";
                $feees = query($query);
                $total_fees = mysqli_num_rows($feees);
                if (($total_fees / $total_students) * 100 < 50) {
                ?> 
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-header card-bg-header text-dark mb-3">
                                <h5 class="mb-0">
                                    <strong>Issue Fees(school) - </strong><?php echo date('Y') . ', ' . date('F'); ?>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="Fees & Funds will be issued to all the students whose fees is not issued.">
                                        <button type="button" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-question"></i></button>
                                    </span>
                                </h5>
                            </div>
                            <div class="row mb-3 px-3">
                                <div class="col-sm-4 mb-1">
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
                                <div class="col-sm-4 mb-1">
                                    <div class="form-check ps-5" id="fund1">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_funds()" value="" id="fund1_ch">
                                        <label class="form-check-label" for="fund1">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund1_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_one_t"
                                                    name="fund1t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_one"
                                                    name="fund1"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-1">
                                    <div class="form-check ps-5" id="fund2">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_funds()" value="" id="fund2_ch">
                                        <label class="form-check-label" for="fund2">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund2_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_two_t"
                                                    name="fund2t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_two"
                                                    name="fund2"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 offset-sm-4 mb-1">
                                    <div class="form-check ps-5" id="fund3">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_funds()" value="" id="fund3_ch">
                                        <label class="form-check-label" for="fund3">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund3_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_three_t"
                                                    name="fund3t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_three"
                                                    name="fund3"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-1">
                                    <div class="form-check ps-5" id="fund4">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="add_funds()" value="" id="fund4_ch">
                                        <label class="form-check-label" for="fund4">
                                            <strong>Add Fund?</strong>
                                        </label>
                                    </div>
                                    <div id="fund4_d" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center mt-2">
                                            <div class="col-sm-7">
                                                <input
                                                    id="fund_four_t"
                                                    name="fund4t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Funds title">
                                            </div>
                                            <div class="col-sm-5">
                                                <input
                                                    id="fund_four"
                                                    name="fund4"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php
                } // end if to issue fees to all school
            } // if the issue fees button is pressed
            ?>

            <?php
            // adding unpaid fees to dues
            if (isset($_POST['add_unpaid'])) {
                $query = "SELECT * FROM student_fee ";
                $query .= "WHERE (fee_status='unpaid' OR fee_status='rejected') ";
                $query .= "AND student_fee.fk_client_id='$client'";
                $get_unpaid = query($query);
                while ($row = mysqli_fetch_assoc($get_unpaid)) {
                    $fee_id = $row['fee_id'];
                    $fee = $row['total_fee'];

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
            $query .= "WHERE (fee_status='unpaid' OR fee_status='rejected') ";
            $query .= "AND student_fee.fk_client_id='$client'";
            $check_fee = query($query);
            if (mysqli_num_rows($check_fee) != 0) {
            ?>
                <form action="" method="post">
                    <div class="row mb-3">

                        <code>- Unpaid fees will be added to pending dues.</code>
                        <div class="col-sm-4">
                            <button type="submit" name="add_unpaid" class="btn btn-sm btn-success">Add to Dues</button>
                        </div>
                    </div>
                </form>
            <?php } ?>

        </div>
    </div><!-- End Select Student and add Student -->


</main><!-- End #main -->

<script>
    // to show and hide the partial payment input
    function add_funds() {
        // alert("This is working");
        var is_fund1 = document.getElementById('fund1_ch').checked;
        var is_fund2 = document.getElementById('fund2_ch').checked;
        var is_fund3 = document.getElementById('fund3_ch').checked;
        var is_fund4 = document.getElementById('fund4_ch').checked;

        // if fund1 is checked
        if (is_fund1 == true) {
            document.getElementById("fund1_d").style.display = "block";
        } else {
            document.getElementById("fund1_d").style.display = "none";
            document.getElementById("fund_one").value = "";
        }

        // if fund2 is checked
        if (is_fund2 == true) {
            document.getElementById("fund2_d").style.display = "block";
        } else {
            document.getElementById("fund2_d").style.display = "none";
            document.getElementById("fund_two").value = "";
        }

        // if fund3 is checked
        if (is_fund3 == true) {
            document.getElementById("fund3_d").style.display = "block";
        } else {
            document.getElementById("fund3_d").style.display = "none";
            document.getElementById("fund_three").value = "";
        }

        // if fund4 is checked
        if (is_fund4 == true) {
            document.getElementById("fund4_d").style.display = "block";
        } else {
            document.getElementById("fund4_d").style.display = "none";
            document.getElementById("fund_four").value = "";
        }
    }

    // show and hide partial payment inputs class wise
    function add_fund() {
        var is_fund5 = document.getElementById('fund5_ch').checked;
        var is_fund6 = document.getElementById('fund6_ch').checked;
        var is_fund7 = document.getElementById('fund7_ch').checked;
        var is_fund8 = document.getElementById('fund8_ch').checked;


        // if fund5 is checked
        if (is_fund5 == true) {
            document.getElementById("fund5_d").style.display = "block";
        } else {
            document.getElementById("fund5_d").style.display = "none";
            document.getElementById("fund_five").value = "";
        }

        // if fund6 is checked
        if (is_fund6 == true) {
            document.getElementById("fund6_d").style.display = "block";
        } else {
            document.getElementById("fund6_d").style.display = "none";
            document.getElementById("fund_six").value = "";
        }

        // if fund7 is checked
        if (is_fund7 == true) {
            document.getElementById("fund7_d").style.display = "block";
        } else {
            document.getElementById("fund7_d").style.display = "none";
            document.getElementById("fund_seven").value = "";
        }

        // if fund8 is checked
        if (is_fund8 == true) {
            document.getElementById("fund8_d").style.display = "block";
        } else {
            document.getElementById("fund8_d").style.display = "none";
            document.getElementById("fund_eight").value = "";
        }
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>