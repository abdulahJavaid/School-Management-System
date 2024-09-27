<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
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
        <h1>Student Dues</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Students Due Requests</h5>
                        <!-- <p>Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> -->

                        <!-- Primary Color Bordered Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">Reg no#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Total Dues</th>
                                        <th scope="col">Payment date</th>
                                        <th scope="col">Fee Method</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // the students who have paid fee
                                    // $query = "SELECT * FROM student_fee INNER JOIN student_profile ON ";
                                    // $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                    // $query .= "WHERE fee_status='due_request'";
                                    $query = "SELECT * FROM student_profile WHERE student_status='1' AND fk_client_id='$client'";
                                    $result = query($query);
                                    $dues = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $std_id = escape($row['student_id']);
                                        $query = "SELECT * FROM student_fee WHERE fk_student_id='$std_id' AND fk_client_id='$client'";
                                        $res = query($query);
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            if ($rows['fee_status'] == 'due_request' || $rows['fee_status'] == 'dues_request') {
                                                $query = "SELECT * FROM student_fee WHERE fk_student_id='$std_id' AND fk_client_id='$client' ";
                                                $query .= "AND (fee_status='dues' OR fee_status='dues_request' OR fee_status='due_request')";
                                                // $query .= "";
                                                $rslt = query($query);
                                                while ($ros = mysqli_fetch_assoc($rslt)) {
                                                    $dues += $ros['pending_dues'];
                                                }

                                    ?>
                                                <tr>
                                                    <td><?php echo $row['roll_no']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td>Rs. <?php echo $dues; ?></td>
                                                    <td><?php echo $rows['payment_date']; ?></td>
                                                    <td><?php echo $rows['fee_method']; ?></td>
                                                    <td>
                                                        <?php
                                                        if (str_contains(strtolower($rows['fee_method']), 'cash')) {
                                                            echo "---";
                                                        } else {
                                                            $img = $rows['receipt_image'];
                                                            echo "<img src='uploads/fees/$img' width='50px' height='50px' alt='no-img'>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><a href="process-dues-requests.php?id=<?php echo $row['student_id']; ?>" class="btn btn-sm btn-success">Process</a></td>
                                                </tr>


                                        <?php
                                                break;
                                            }
                                        }
                                        ?>

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