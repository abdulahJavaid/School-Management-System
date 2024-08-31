<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// checking session for appropriate access
if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'accountant' || $_SESSION['login_access'] == 'super') {
  
}else{
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
        <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Students Fee Requests</h5>
            <!-- <p>Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> -->

            <!-- Primary Color Bordered Table -->
            <table class="table table-bordered border-primary">
              <thead>
                <tr>
                  <th scope="col">Reg no#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Monthly Fee (Rs)</th>
                  <th scope="col">Month</th>
                  <th scope="col">Payment date</th>
                  <th scope="col">Fee Method</th>
                  <th scope="col">Image</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // the students who have paid fee
                $query = "SELECT * FROM student_fee INNER JOIN student_profile ON ";
                $query .= "student_fee.fk_student_id=student_profile.student_id ";
                $query .= "WHERE fee_status='fee_request'";
                $result = query($query);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['roll_no']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>Rs. <?php echo $row['monthly_fee']; ?></td>
                    <td><?php echo $row['year'] . ', ' . $row['month']; ?></td>
                    <td><?php echo $row['payment_date']; ?></td>
                    <td><?php echo $row['fee_method']; ?></td>
                    <td>
                      <?php
                      if (str_contains(strtolower($row['fee_method']), 'cash')) {
                        echo "---";
                      } else {
                        $img = $row['receipt_image'];
                        echo "<img src='uploads/fees/$img' width='50px' height='50px' alt='no-img'>";
                      }
                      ?>
                    </td>
                    <td><a href="process-fee-requests.php?id=<?php echo $row['fee_id']; ?>" class="btn btn-sm btn-info button">Process</a></td>
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