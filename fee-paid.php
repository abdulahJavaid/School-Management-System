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

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Student Fees</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">School name here</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Students who paid fees</h5>
                        <!-- <p>Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> -->
                        <div class="d-flex justify-content-end">
    <div class="input-group w-auto">
        <!-- <select name="" id="" class="form-select" 
        aria-describedby="button-addon1">
            <option value=""><?php // echo date('Y') .', ' . date('F') ?></option>
        </select> -->
        <input
          type="month"
          size="4"
          class="form-control"
          value="<?php echo date('Y') .'-' . date('m') ?>"
          placeholder="Example input"
          aria-label="Example input"
          aria-describedby="button-addon1"
        />
        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-sm btn-primary button" type="submit" id="button-addon1" data-mdb-ripple-color="dark">
            View
        </button>
    </div>
</div>
                        <br>
                        <!-- Primary Color Bordered Table -->
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Reg no#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Monthly Fee (Rs)</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Dues</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // the students who have paid fee
                                $year = date('Y');
                                $month = date('F');
                                $query = "SELECT * FROM student_fee INNER JOIN student_profile ON ";
                                $query .= "student_fee.fk_student_id=student_profile.student_id ";
                                $query .= "WHERE fee_status='paid' AND year='$year' AND month='$month'";
                                $result = query($query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['roll_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>Rs. <?php echo $row['monthly_fee']; ?></td>
                                        <td><?php echo $row['year'] . ', ' . $row['month']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['fee_status'] == 'paid') {
                                                echo $row['monthly_fee'];
                                            } else {
                                                $dues = (int) $row['pending_dues'];
                                                $paid = (int) $row['monthly_fee'] - $dues;
                                                echo $paid;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $row['pending_dues']; ?>
                                        </td>
                                        <td>
                                            <!-- <form action="generate-pdf.php">
                                                input
                                            </form> -->
                                            <a href="generate-pdf.php?generate=on">Generate</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Primary Color Bordered Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>