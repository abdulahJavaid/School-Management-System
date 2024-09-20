<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'accountant' || $_SESSION['login_access'] == 'super') {
} else {
  redirect("./");
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Staff Salaries</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- download pdfs -->
  <div class="row mb-3">
    <div class="col-md-5 col-sm-6">
      <form action="./generate-pdf.php" method="post">
        <div class="input-group">
          <input
            name="salary_p_month"
            type="month"
            class="form-control"
            value="<?php if (isset($_POST['view_month'])) {
                      echo $_POST['month'];
                    } else {
                      echo date('Y') . '-' . date('m');
                    } ?>"
            placeholder="Example input"
            aria-label="Example input"
            aria-describedby="button-addon1" required />
          <button name="generate_paid_salary" class="btn btn-sm btn-success" type="submit" id="button-addon1">
            Pdf Paid Salaries
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- end download pdfs -->



  <section class="section profile">
    <!-- First Card -->
    <!-- <div class="col-md-6"> -->

    <div class="card">
      <div class="card-body">

        <h5 class="card-title">Staff Salaries</h5>
        <p>Pending salary payments.</p>

        <div class="table-responsive">
          <table class="table table-bordered border-primary table-hover">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Designation</th>
                <th scope="col">Salary</th>
                <th scope="col">Month</th>
                <th scope="col">Payment</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // the current date
              $date = date('Y-m-d', time());
              $date = escape($date);

              // select the records from database of today
              $query = "SELECT * FROM teacher_profile INNER JOIN employee_salary ON ";
              $query .= "teacher_profile.teacher_id=employee_salary.fk_teacher_id WHERE ";
              $query .= "salary_status='unpaid' AND teacher_status='1' AND teacher_profile.fk_client_id='$client'";
              $result = query($query);
              while ($row = mysqli_fetch_assoc($result)) {
                $sal_id = $row['salary_id'];
              ?>
                <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td>Teacher</td>
                  <td>Rs.<?php echo $row['salary_amount']; ?></td>
                  <td><?php echo $row['month'] . ', ' . $row['year']; ?></td>
                  <td><a href="./process-salaries.php?id=<?php echo $sal_id; ?>" class="btn btn-sm btn-success">Process</a></td>
                </tr>
              <?php
              }
              ?>
              <?php
              // the current date
              $date = date('Y-m-d', time());
              $date = escape($date);

              // select the records from database of today
              $query = "SELECT * FROM staff_profile INNER JOIN employee_salary ON ";
              $query .= "staff_profile.staff_id=employee_salary.fk_staff_id WHERE ";
              $query .= "salary_status='unpaid' AND staff_status='1' AND staff_profile.fk_client_id='$client'";
              $result = query($query);
              while ($rows = mysqli_fetch_assoc($result)) {
                $sal_id = $rows['salary_id'];
              ?>
                <tr>
                  <td><?php echo $rows['name']; ?></td>
                  <td><?php echo $rows['staff_designation']; ?></td>
                  <td>Rs.<?php echo $rows['salary_amount']; ?></td>
                  <td><?php echo $rows['month'] . ', ' . $rows['year']; ?></td>
                  <td><a href="./process-salaries.php?id=<?php echo $sal_id; ?>" class="btn btn-sm btn-success">Process</a></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>



    </div><!-- End Row -->
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>