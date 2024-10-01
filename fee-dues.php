<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id'])
?>

<?php
// checking session for appropriate access
if ($level == 'accountant' || $level == 'super') {}
else {
  redirect("./");
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Student Pending Dues</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- generate pdf button -->
    <div class="row">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="input-group">
                        <?php
                        // pdf with username
                        if (isset($_POST['view_name'])) {
                            $view_name = $_POST['name'];
                        ?>

                            <form action="generate-pdf.php" method="post">
                                <input type="hidden" name="due_name" value="<?php echo $_POST['name']; ?>">
                                <button name="dues_name" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                    Generate Pdf
                                </button>
                            </form>
                        <?php
                        } elseif (isset($_POST['view_reg'])) {
                        ?>

                            <form action="generate-pdf.php" method="post">
                                <input type="hidden" name="due_roll_no" value="<?php echo $_POST['reg']; ?>">
                                <button name="dues_reg" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                    Generate Pdf
                                </button>
                            </form>
                        <?php
                        } elseif (isset($_POST['view_month'])) {
                            $date = $_POST['month'] . '-01';
                        ?>

                            <form action="generate-pdf.php" method="post">
                                <input type="hidden" name="due_month" value="<?php echo $date; ?>">
                                <button name="dues_month" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                    Generate Pdf
                                </button>
                            </form>
                        <?php
                        } else {
                        ?>

                            <form action="generate-pdf.php" method="post">
                                <input type="hidden" name="due_current" value="not-empty">
                                <button name="dues_current_month" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                    Generate Pdf
                                </button>
                            </form>
                        <?php
                        }
                        ?>

                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>

    <p><code>The pdf will be generated for the selected option. If no option is selected, current month record will be generated</code></p>
    <!-- <br> -->

    <!-- the table with the data -->
    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Students with pending dues</h5>
                        <div class="row">
                            <div class="container">
                                <div class="row align-items-center">
                                    <!-- Name Button on the Left -->

                                    <div class="col-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input
                                                    name="name"
                                                    type="text"
                                                    size="6"
                                                    class="form-control"
                                                    value="<?php
                                                            if (isset($_POST['view_name'])) {
                                                                echo $_POST['name'];
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>"
                                                    placeholder="By name"
                                                    aria-label="Example input"
                                                    aria-describedby="button-addon2" required />
                                                <button name="view_name" class="btn btn-sm btn-success" type="submit" id="button-addon2">
                                                    View
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                    <!-- button position second -->

                                    <div class="col-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input
                                                    name="reg"
                                                    type="text"
                                                    size="6"
                                                    class="form-control"
                                                    value="<?php
                                                            if (isset($_POST['view_reg'])) {
                                                                echo $_POST['reg'];
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>"
                                                    placeholder="By reg#"
                                                    aria-label="Example input"
                                                    aria-describedby="button-addon3" required />
                                                <button name="view_reg" class="btn btn-sm btn-success" type="submit" id="button-addon3">
                                                    View
                                                </button>
                                            </div>
                                        </form>
                                    </div>



                                    <!-- Month Input and View Button on the Right -->

                                    <div class="col-auto ms-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input
                                                    name="month"
                                                    type="month"
                                                    class="form-control"
                                                    value="<?php if (isset($_POST['view_month'])) {
                                                                echo $_POST['month'];
                                                            } elseif (isset($_POST['view_name']) || isset($_POST['view_reg']) || isset($_POST['view_class'])) {
                                                                echo "";
                                                            } else {
                                                                echo date('Y') . '-' . date('m');
                                                            } ?>"
                                                    placeholder="Example input"
                                                    aria-label="Example input"
                                                    aria-describedby="button-addon1" required />
                                                <button name="view_month" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                                    View
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- </br> -->

                        <br>
                        <!-- Primary Color Bordered Table -->
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
                                        <th scope="col">Paid Amount</th>
                                        <th scope="col">Dues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // the students who have paid fee
                                    if (isset($_POST['view_month'])) {
                                        $date = $_POST['month'] . '-01';
                                        $year = date('Y', strtotime($date));
                                        $year = escape($year);
                                        $month = date('F', strtotime($date));
                                        $month = escape($month);
                                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                                        $query .= "INNER JOIN student_profile ON ";
                                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                        $query .= "WHERE (fee_status='dues' OR fee_status='due_request' OR fee_status='dues_request') AND year='$year' AND month='$month' ";
                                        $query .= "AND student_status='1' AND student_fee.fk_client_id='$client'";
                                    } elseif (isset($_POST['view_name'])) {
                                        $name = escape($_POST['name']);
                                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                                        $query .= "INNER JOIN student_profile ON ";
                                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                        $query .= "WHERE name LIKE '%$name%' AND student_status='1' AND student_fee.fk_client_id='$client' AND (fee_status='dues' OR fee_status='due_request' OR fee_status='dues_request') ORDER BY fee_id DESC";
                                    } elseif (isset($_POST['view_reg'])) {
                                        $roll_no = escape($_POST['reg']);
                                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                                        $query .= "INNER JOIN student_profile ON ";
                                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                        $query .= "WHERE roll_no='$roll_no' AND student_status='1' AND student_fee.fk_client_id='$client' AND (fee_status='dues' OR fee_status='due_request' OR fee_status='dues_request') ORDER BY fee_id DESC";
                                    } else {
                                        $year = date('Y');
                                        $month = date('F');
                                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                                        $query .= "INNER JOIN student_profile ON ";
                                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                        $query .= "WHERE (fee_status='dues' OR fee_status='due_request' OR fee_status='dues_request') AND year='$year' AND month='$month' ";
                                        $query .= "AND student_status='1' AND student_fee.fk_client_id='$client'";
                                    }
                                    // looping to get the funds record
                                    $result = query($query);
                                    $funds = [];
                                    $main_data = [];
                                    while ($rows = mysqli_fetch_assoc($result)) {
                                        $main_id = $rows['fee_id'];
                                        if (!empty($rows['fk_fee_id'])) {
                                            if (!isset($funds[$main_id])) {
                                                $funds[$main_id] = [
                                                    'funds' => []
                                                ];
                                            }
                                            $funds[$main_id]['funds'][] = '<strong>' . $rows['fund_title'] . '</strong><br>' . $rows['fund_amount'] . '<br>';
                                        }
                                        if (!isset($main_data[$main_id])) {
                                            $main_data[$main_id] = $rows;
                                        }
                                    }
                                    // showing the records in the main table
                                    foreach ($main_data as $row) {
                                        $current_id = $row['fee_id'];
                                    ?>
                                        <tr>
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td>Rs.<?php echo $row['monthly_fee']; ?></td>
                                            <td>
                                                <?php
                                                // getting the funds from the loop
                                                if (isset($funds[$current_id])) {
                                                    foreach ($funds[$current_id]['funds'] as $get) {
                                                        echo $get;
                                                    }
                                                } else {
                                                    echo "---";
                                                }
                                                ?>
                                            </td>
                                            <td>Rs.<?php echo $row['total_fee']; ?></td>
                                            <td><?php echo $row['year'] . ', ' . $row['month']; ?></td>
                                            <td>
                                                <?php
                                                if ($row['fee_status'] == 'paid') {
                                                    echo 'Rs.'.$row['total_fee'];
                                                } else {
                                                    $dues = (int) $row['pending_dues'];
                                                    $paid = (int) $row['total_fee'] - $dues;
                                                    echo 'Rs.'. $paid;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo 'Rs.' . $row['pending_dues']; ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Primary Color Bordered Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>