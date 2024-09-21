<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// if get request is valid
if (!isset($_GET['id'])) {
    redirect("./salaries.php");
}
?>

<?php
// checking session for appropriate access
if ($level == 'accountant' || $level == 'super') {}
else {
  redirect("./");
}
?>

<?php
// if the form is submitted and the employee is teacher
if (isset($_POST['paid'])) {

    $salary_id = escape($_GET['id']);
    $total_salary = $_POST['total_salary'];
    $length = strlen($total_salary);
    $salary = substr($total_salary, 3, $length);
    $salary = escape($salary);
    $today = date('Y-m-d', time());
    // $var = 0;
    if (!empty($_POST['bonus1'])) {
        // $var += 1;
        $bonus1t = $_POST['bonus1t'];
        $bonus1 = $_POST['bonus1'];
        $query = "INSERT INTO salary_bonus(fk_salary_id, bonus_title, bonus_amount, fk_client_id) ";
        $query .= "VALUES('$salary_id', '$bonus1t', '$bonus1', '$client')";
        $pass_bonus1 = query($query);
    }
    if (!empty($_POST['bonus2'])) {
        // $var += 1;
        $bonus2t = $_POST['bonus2t'];
        $bonus2 = $_POST['bonus2'];
        $query = "INSERT INTO salary_bonus(fk_salary_id, bonus_title, bonus_amount, fk_client_id) ";
        $query .= "VALUES('$salary_id', '$bonus2t', '$bonus2', '$client')";
        $pass_bonus2 = query($query);
    }
    if (!empty($_POST['bonus3'])) {
        // $var += 1;
        $bonus3t = $_POST['bonus3t'];
        $bonus3 = $_POST['bonus3'];
        $query = "INSERT INTO salary_bonus(fk_salary_id, bonus_title, bonus_amount, fk_client_id) ";
        $query .= "VALUES('$salary_id', '$bonus3t', '$bonus3', '$client')";
        $pass_bonu3 = query($query);
    }

    // getting the paid salary amount
    $query = "UPDATE employee_salary SET payment_date='$today', paid_salary='$salary', salary_status='paid'";
    $query .= "WHERE salary_id='$salary_id' AND fk_client_id='$client'";
    $paid_salary = query($query);

    // adding the entry into the expense sheet
    $date = date('Y-m-d', time());
    $name = escape($_POST['name']);
    $type = escape($_POST['type']);
    if ($type == 'teacher') {
        $comments = "Salary of teacher $name was paid.";
        // fetching the admin id and adding the data
        $id = escape($_SESSION['login_id']);
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> paid salary to teacher <strong>$name</strong> !";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);
    
    } else {
        $designation = $_POST['designation'];
        $comments = "Salary of " . $designation . " " . $name . "was paid.";
        // fetching the admin id and adding the data
        $id = escape($_SESSION['login_id']);
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> paid salary to $designation <strong>$name</stron> !";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_query2 = mysqli_query($conn, $query);

    }
    $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date, fk_client_id) ";
    $qer .= "VALUES ('$comments', '$salary', '0', '$date', '$client')";
    $res = query($qer);

    redirect("./salaries.php");
}

?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Staff Salary</h1>
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
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Salary</button>
                            </li>
                        </ul>
                        <?php
                        // fetching the salary record
                        $salary_id = escape($_GET['id']);
                        $query = "SELECT * FROM employee_salary WHERE salary_id='$salary_id' AND fk_client_id='$client'";
                        $salary_record = query($query);
                        $get_salary = mysqli_fetch_assoc($salary_record);

                        if ($get_salary['fk_staff_id'] == 0) {
                            $tch_id = $get_salary['fk_teacher_id'];
                            $query = "SELECT * FROM teacher_profile WHERE teacher_id='$tch_id' AND teacher_status='1' AND fk_client_id='$client'";
                            $teacher_record = query($query);
                            $get_record = mysqli_fetch_assoc($teacher_record);
                        } else {
                            $staff_id = $get_salary['fk_staff_id'];
                            $query = "SELECT * FROM staff_profile WHERE staff_id='$staff_id' AND staff_status='1' AND fk_client_id='$client'";
                            $staff_record = query($query);
                            $get_record = mysqli_fetch_assoc($staff_record);
                        }
                        ?>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-primary table-hover">
                                        <thead>
                                            <?php
                                            $today = date('Y-m-d', time());
                                            ?>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Salary</th>
                                                <th scope="col">Month</th>
                                                <th scope="col">Payment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $get_record['name']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($get_salary['fk_staff_id'] == 0) {
                                                        echo "Teacher";
                                                    } else {
                                                        echo $get_record['staff_designation'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>Rs. <?php echo $get_salary['salary_amount']; ?></td>
                                                <td><?php echo $get_salary['month'] . ', ' . $get_salary['year']; ?></td>
                                                <td><?php echo $today; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-check" id="partial_payment_c">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="partial_payment()" value="" id="partial_payment_ch">
                                        <label class="form-check-label" for="partial_payment">
                                            Partial Payment?
                                        </label>
                                    </div>
                                    <p id="partial_payment_p" style="display: none;"><code>Add salary here only if you don't want to pay full salary.</code></p>
                                    <div class="row mb-3" id="partial_payment_i" style="display: none;">
                                        <div class="col-sm-6">
                                            <input
                                                id="salary_payment"
                                                name="salary_payment"
                                                type="text"
                                                class="form-control"
                                                value=""
                                                placeholder="Rs.">
                                        </div>
                                    </div>
                                    <div class="form-check" id="bonus1">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="partial_payment()" value="" id="bonus1_ch">
                                        <label class="form-check-label" for="bonus1">
                                            Give bonus?
                                        </label>
                                    </div>
                                    <div id="bonus1_i" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center">
                                            <div class="col-sm-4">
                                                <input
                                                    id="bonus_one_t"
                                                    name="bonus1t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Bonus title">
                                            </div>
                                            <div class="col-sm-3">
                                                <input
                                                    id="bonus_one"
                                                    name="bonus1"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check" id="bonus2">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="partial_payment()" value="" id="bonus2_ch">
                                        <label class="form-check-label" for="bonus2">
                                            Give bonus?
                                        </label>
                                    </div>
                                    <div id="bonus2_i" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center">
                                            <div class="col-sm-4">
                                                <input
                                                    id="bonus_one_t"
                                                    name="bonus2t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Bonus title">
                                            </div>
                                            <div class="col-sm-3">
                                                <input
                                                    id="bonus_two"
                                                    name="bonus2"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check" id="bonus3">
                                        <input class="form-check-input border-dark" type="checkbox" onclick="partial_payment()" value="" id="bonus3_ch">
                                        <label class="form-check-label" for="bonus3">
                                            Give bonus?
                                        </label>
                                    </div>
                                    <div id="bonus3_i" style="display: none;">
                                        <div class="row mb-3 d-flex align-items-center">
                                            <div class="col-sm-4">
                                                <input
                                                    id="bonus_one_t"
                                                    name="bonus3t"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Bonus title">
                                            </div>
                                            <div class="col-sm-3">
                                                <input
                                                    id="bonus_three"
                                                    name="bonus3"
                                                    type="text"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Rs.">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mb-4 mt-4">
                                        <div class="form-group row">
                                            <label for="total_salary" class="col-sm-3 col-form-label"><strong>Total</strong></label>
                                            <div class="col-sm-8">
                                                <input
                                                    id="total_salary"
                                                    name="total_salary"
                                                    type="text"
                                                    value="Rs.<?php echo $get_salary['salary_amount']; ?>"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <?php
                                        if ($get_salary['fk_staff_id'] == 0) {
                                        ?>
                                            <input type="hidden" name="type" value="teacher">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="hidden" name="designation" value="<?php echo $get_record['staff_designation']; ?>">
                                            <input type="hidden" name="type" value="staff">
                                        <?php
                                        }
                                        ?>
                                        <input type="hidden" name="name" value="<?php echo $get_record['name']; ?>">
                                        <button type="submit" name="paid" class="btn btn-sm btn-success">Mark Paid</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
            <div class="col-xl-3">
                <div class="card">
                    <?php
                    $img = "pay-day-default-image.jpg";
                    echo "<img src='images/$img' alt='no-img'>";
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                            echo "Pay Day";
                            ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<script>
    // checking if all the checkboxes are not selected
    function check() {
        var is_checked = document.getElementById('partial_payment_ch').checked;
        var is_bonus1 = document.getElementById('bonus1_ch').checked;
        var is_bonus2 = document.getElementById('bonus2_ch').checked;
        var is_bonus3 = document.getElementById('bonus3_ch').checked;
        if (is_checked != true && is_bonus1 != true && is_bonus2 != true && is_bonus3 != true) {
            var sal = "<?php echo (int) $get_salary['salary_amount']; ?>";
            document.getElementById("total_salary").value = "Rs." + sal;
        }
    }
    check();

    // to show and hide the partial payment input
    function partial_payment() {
        // alert("This is working");
        var is_checked = document.getElementById('partial_payment_ch').checked;
        var is_bonus1 = document.getElementById('bonus1_ch').checked;
        var is_bonus2 = document.getElementById('bonus2_ch').checked;
        var is_bonus3 = document.getElementById('bonus3_ch').checked;
        // if partial payment is checked
        if (is_checked == true) {
            document.getElementById("partial_payment_p").style.display = "block";
            document.getElementById("partial_payment_i").style.display = "block";
            document.getElementById("salary_payment").addEventListener('input', calculate_salary);
        } else {
            document.getElementById("partial_payment_p").style.display = "none";
            document.getElementById("partial_payment_i").style.display = "none";
            document.getElementById("salary_payment").removeEventListener('input', calculate_salary);
            document.getElementById("salary_payment").value = "";
        }
        // if bonus1 is checked
        if (is_bonus1 == true) {
            document.getElementById("bonus1_i").style.display = "block";
            document.getElementById("bonus_one").addEventListener('input', calculate_salary);
        } else {
            document.getElementById("bonus1_i").style.display = "none";
            document.getElementById("bonus_one").removeEventListener('input', calculate_salary);
            document.getElementById("bonus_one").value = "";
        }
        // if bonus2 is checked
        if (is_bonus2 == true) {
            document.getElementById("bonus2_i").style.display = "block";
            document.getElementById("bonus_two").addEventListener('input', calculate_salary);
        } else {
            document.getElementById("bonus2_i").style.display = "none";
            document.getElementById("bonus_two").removeEventListener('input', calculate_salary);
            document.getElementById("bonus_two").value = "";
        }
        // if bonus3 is checked
        if (is_bonus3 == true) {
            document.getElementById("bonus3_i").style.display = "block";
            document.getElementById("bonus_three").addEventListener('input', calculate_salary);
        } else {
            document.getElementById("bonus3_i").style.display = "none";
            document.getElementById("bonus_three").removeEventListener('input', calculate_salary);
            document.getElementById("bonus_three").value = "";
        }
        calculate_salary();
    }

    // to automatically calculate the total salary
    function calculate_salary() {
        var total = 0;
        // partial payment input
        var partial = document.getElementById("partial_payment_i").style.display;
        // bonus1 input
        var bonus1 = document.getElementById("bonus1_i").style.display;
        // bonus2 input
        var bonus2 = document.getElementById("bonus2_i").style.display;
        // bonus3 input
        var bonus3 = document.getElementById("bonus3_i").style.display;
        if (partial != "none") {
            var payment1 = document.getElementById("salary_payment").value || 0;
            total += parseFloat(payment1);
        } else {
            var salar = "<?php echo (int) $get_salary['salary_amount']; ?>";
            total += parseFloat(salar);
        }
        if (bonus1 != "none") {
            var payment2 = document.getElementById("bonus_one").value || 0;
            total += parseFloat(payment2);
        }
        if (bonus2 != "none") {
            var payment3 = document.getElementById("bonus_two").value || 0;
            total += parseFloat(payment3);
        }
        if (bonus3 != "none") {
            var payment4 = document.getElementById("bonus_three").value || 0;
            total += parseFloat(payment4);
        }
        document.getElementById("total_salary").value = "Rs." + total;
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>