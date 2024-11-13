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
// add more fees for the student
if (isset($_POST['addmore'])) {
    $fee_id = escape($_POST['fk_fee_id']);
    $fund_title = escape($_POST['fund_title']);
    $fund_amount = escape($_POST['fund_amount']);
    $total_fee = escape($_POST['total_fee']);

    // adding the additional amount into the funds table
    $query = "INSERT INTO student_funds(fk_fee_id, fund_title, fund_amount, fk_client_id) ";
    $query .= "VALUES('$fee_id', '$fund_title', '$fund_amount', '$client')";
    $add_more = query($query);

    if ($add_more) {
        $total = (int) $total_fee + (int) $fund_amount;
        // updating the total fees of the student
        $query = "UPDATE student_fee SET total_fee='$total' WHERE fee_id='$fee_id' AND fk_client_id='$client'";
        $update_total = query($query);

        if ($update_total) {
            redirect('./fee-not-paid.php');
        }
    }
}

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Student Fees not-paid</h1>
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
                                <input type="hidden" name="npaid_name" value="<?php echo $_POST['name']; ?>">
                                <button name="notpaid_name" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                    Generate Pdf
                                </button>
                            </form>
                        <?php
                        } elseif (isset($_POST['view_reg'])) {
                        ?>

                            <form action="generate-pdf.php" method="post">
                                <input type="hidden" name="npaid_roll_no" value="<?php echo $_POST['reg']; ?>">
                                <button name="notpaid_reg" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                    Generate Pdf
                                </button>
                            </form>
                        <?php
                            // this eleseif() will never be executed on this page
                        } elseif (isset($_POST['view_month'])) {
                            $date = $_POST['month'] . '-01';
                        ?>

                            <form action="generate-pdf.php" method="post">
                                <input type="hidden" name="npaid_month" value="<?php echo $date; ?>">
                                <button name="notpaid_month" class="btn btn-sm btn-success" type="submit" id="button-addon1">
                                    Generate Pdf
                                </button>
                            </form>
                        <?php
                        } else {
                        ?>

                            <form action="generate-pdf.php" method="post">
                                <input type="hidden" name="npaid_current" value="not-empty">
                                <button name="notpaid_current_month" class="btn btn-sm btn-success" type="submit" id="button-addon1">
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
                                        <th scope="col">Add More</th>
                                        <!-- <th scope="col">Dues</th> -->
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
                                        $query .= "WHERE (fee_status='unpaid' OR fee_status='rejected') AND year='$year' AND month='$month' ";
                                        $query .= "AND student_status='1' AND student_fee.fk_client_id='$client'";
                                    } elseif (isset($_POST['view_name'])) {
                                        $name = escape($_POST['name']);
                                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                                        $query .= "INNER JOIN student_profile ON ";
                                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                        $query .= "WHERE name LIKE '%$name%' AND (fee_status='unpaid' OR fee_status='rejected') AND student_status='1' ";
                                        $query .= "AND student_fee.fk_client_id='$client' ORDER BY fee_id DESC";
                                    } elseif (isset($_POST['view_reg'])) {
                                        $roll_no = escape($_POST['reg']);
                                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                                        $query .= "INNER JOIN student_profile ON ";
                                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                        $query .= "WHERE roll_no='$roll_no' AND (fee_status='unpaid' OR fee_status='rejected') AND student_status='1' ";
                                        $query .= "AND student_fee.fk_client_id='$client' ORDER BY fee_id DESC";
                                    } else {
                                        $year = date('Y');
                                        $month = date('F');
                                        $query = "SELECT * FROM student_fee LEFT JOIN student_funds ON ";
                                        $query .= "student_fee.fee_id=student_funds.fk_fee_id ";
                                        $query .= "INNER JOIN student_profile ON ";
                                        $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                        $query .= "WHERE (fee_status='unpaid' OR fee_status='rejected') AND student_status='1' AND year='$year' AND month='$month' ";
                                        $query .= "AND student_fee.fk_client_id='$client'";
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
                                            $funds[$main_id]['funds'][] = '--' . $rows['fund_title'] . '<br>Rs.' . $rows['fund_amount'] . '<br>';
                                        }
                                        if (!isset($main_data[$main_id])) {
                                            $main_data[$main_id] = $rows;
                                        }
                                    }
                                    // showing the records in the main table
                                    foreach ($main_data as $row) {
                                        $current_id = $row['fee_id'];
                                        $std_roll_no = $row['roll_no'];
                                        $std_name = $row['name'];
                                        $std_total_fee = $row['total_fee'];
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
                                            <td class="text-center">
                                                <?php
                                                if ($row['fee_status'] == 'unpaid' || $row['fee_status'] == 'rejected') {
                                                    // echo 'Rs.' . 0;
                                                ?>
                                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#addFee"
                                                        onclick="feeInfo('<?php echo $std_name; ?>', '<?php echo $std_roll_no; ?>', '<?php echo $current_id; ?>', '<?php echo $std_total_fee; ?>')">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                <?php
                                                } else {
                                                    $dues = (int) $row['pending_dues'];
                                                    $paid = (int) $row['monthly_fee'] - $dues;
                                                    echo 'Rs.' . $paid;
                                                }
                                                ?>
                                            </td>
                                            <!-- <td>
                                            <?php //echo $row['monthly_fee']; 
                                            ?>
                                        </td> -->
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

    <!-- The modal to add more amount to student fee -->
    <div class="modal fade" id="addFee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-bg-header text-white">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong>Fees addition</strong></h5>
                    <button type="button" class="ms-auto bg-transparent border-0 text-white" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body" id="">
                        <p class="lead" id="addFeeReg"><strong>Reg#: </strong></p>
                        <p class="lead" id="addFeeName"><strong>Name: </strong></p>
                        <input type="hidden" name="fk_fee_id" id="addFeeFkId">
                        <input type="hidden" name="total_fee" id="addFeeTotalFee">
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label"><strong>Title</strong> <code>*</code></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="fund_title" type="text" class="form-control" id="fullName" placeholder="Stationary etc." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label"><strong>Amount</strong> <code>*</code></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="fund_amount" type="text" class="form-control" id="fullName" placeholder="Rs." required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addmore" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<script>
    function feeInfo(stdName, rollNo, feeId, total) {
        var name = document.getElementById('addFeeName');
        var reg = document.getElementById('addFeeReg');
        var fkId = document.getElementById('addFeeFkId');
        var totalFee = document.getElementById('addFeeTotalFee');

        name.innerHTML = '<strong>Name# </strong>' + stdName;
        reg.innerHTML = '<strong>Reg# </strong>' + rollNo;
        fkId.value = feeId;
        totalFee.value = total;
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>